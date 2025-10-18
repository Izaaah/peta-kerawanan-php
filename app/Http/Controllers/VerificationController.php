<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVerification;
use App\Services\DuplicateDetectionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    public function index()
    {
        $verifications = DataVerification::where('status', 'pending')
            ->with('admin')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('super-admin.verification.index', compact('verifications'));
    }

    public function approve($id)
    {
        $verification = DataVerification::findOrFail($id);

        try {
            DB::beginTransaction();

            $oldData = $verification->old_data_array;
            $newData = $verification->new_data_array;

            // Get model class
            $modelClass = '\\App\\Models\\' . Str::studly(Str::singular($verification->table_name));
            if (!class_exists($modelClass)) {
                return redirect()->back()->with('error', "Model $modelClass tidak ditemukan.");
            }

            // Prepare data for validation and processing
            $dataForValidation = $this->prepareDataForValidation($oldData, $newData, $verification->table_name, $verification->data_id);

            // Validate required fields before processing
            $requiredFieldsValidation = $this->validateRequiredFields($dataForValidation, $verification->table_name);
            if ($requiredFieldsValidation !== true) {
                DB::rollback();
                return redirect()->back()->with('error', $requiredFieldsValidation);
            }

            // Process data to handle empty date fields
            $processedData = $this->processDataForSave($dataForValidation, $verification->table_name);

            if ($verification->data_id == 0) {
                // This is a new record (duplicate detected during creation)
                // Create the new record
                $model = new $modelClass();
                $model->fill($processedData);
                $model->save();
            } else {
                // This is an update to existing record
                // Update the existing record with new data
                $model = $modelClass::findOrFail($verification->data_id);
                $model->fill($processedData);
                $model->save();
            }

            // Update verification status
            $verification->status = 'approved';
            $verification->super_admin_id = Auth::id();
            $verification->save();

            DB::commit();

            $successMessage = $verification->data_id == 0
                ? 'Data baru berhasil disetujui dan ditambahkan ke sistem.'
                : 'Data berhasil disetujui dan diperbarui.';

            return redirect()->route('super-admin.verification.index')
                ->with('success', $successMessage);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Approve verifikasi gagal: ' . $e->getMessage(), [
                'verification_id' => $id,
                'data' => $newData,
            ]);
            return redirect()->back()->with('error', 'Gagal memverifikasi data: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        $verification = DataVerification::findOrFail($id);

        try {
            $verification->status = 'rejected';
            $verification->super_admin_id = Auth::id();
            $verification->save();

            return redirect()->route('super-admin.verification.index')
                ->with('success', 'Data ditolak');
        } catch (\Exception $e) {
            Log::error('Reject verifikasi gagal: ' . $e->getMessage(), [
                'verification_id' => $id,
            ]);
            return redirect()->back()->with('error', 'Gagal menolak data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $verification = DataVerification::with('admin')->findOrFail($id);
        $tableDisplayName = DuplicateDetectionService::getTableDisplayName($verification->table_name);
        $fieldLabels = DuplicateDetectionService::getFieldLabels($verification->table_name);

        // Ambil data lengkap dari database jika ini adalah update
        $currentData = null;
        if ($verification->data_id > 0) {
            $modelClass = '\\App\\Models\\' . Str::studly(Str::singular($verification->table_name));
            if (class_exists($modelClass)) {
                $currentData = $modelClass::find($verification->data_id);
            }
        }

        return view('super-admin.verification.show', compact('verification', 'tableDisplayName', 'fieldLabels', 'currentData'));
    }

    /**
     * Get the edit route for a specific table and data ID
     */
    private function getEditRouteForTable($tableName, $dataId)
    {
        $routeMap = [
            'data_individu_tsk' => 'super-admin.data.individu.edit',
            'thm' => 'super-admin.data.thm.edit',
            'lsm_narkotika' => 'super-admin.data.lsm.edit',
            'media_sosial' => 'super-admin.data.medsos.edit',
            'penjual_vape' => 'super-admin.data.vape.edit',
            'perusahaan_farmasi_prekursor' => 'super-admin.data.farmasi.edit',
            'objek_vital' => 'super-admin.data.objekvital.edit',
            'penggiat_narkotika' => 'super-admin.data.penggiat.edit',
            'penginapan' => 'super-admin.data.penginapan.edit',
            'rutan_lapas' => 'super-admin.data.rutanlapas.edit',
            'transportasi' => 'super-admin.data.transportasi.edit',
            'ekspedisi' => 'super-admin.data.ekspedisi.edit',
            'lembaga_rehabilitasi' => 'super-admin.data.lrehab.edit',
        ];

        $routeName = $routeMap[$tableName] ?? 'super-admin.verification.index';

        if ($dataId && $dataId > 0) {
            return route($routeName, $dataId);
        }

        return route('super-admin.verification.index');
    }

    /**
     * Get notification count for AJAX requests
     */
    public function getNotificationCount()
    {
        $count = DataVerification::where('status', 'pending')->count();

        return response()->json([
            'count' => $count,
            'success' => true
        ]);
    }

    /**
     * Prepare data for validation by combining old and new data
     */
    private function prepareDataForValidation($oldData, $newData, $tableName, $dataId)
    {
        if ($dataId == 0) {
            // For new data, use new data only
            return $newData;
        } else {
            // For updates, get current data from database and merge with new data
            $modelClass = '\\App\\Models\\' . Str::studly(Str::singular($tableName));
            if (class_exists($modelClass)) {
                $currentData = $modelClass::find($dataId);
                if ($currentData) {
                    $dataForValidation = $currentData->toArray();

                    // Override with new data for fields that have values
                    foreach ($newData as $key => $value) {
                        if (!empty($value) || $value === '0' || $value === 0) {
                            $dataForValidation[$key] = $value;
                        }
                    }

                    return $dataForValidation;
                }
            }

            // Fallback to old data if current data not found
            return array_merge($oldData, $newData);
        }
    }

    /**
     * Validate required fields
     */
    private function validateRequiredFields($data, $tableName)
    {
        $requiredFieldsMap = [
            'data_individu_tsk' => [
                'nama' => 'Nama',
                'nik' => 'NIK'
            ],
            'thm' => [
                'nama' => 'Nama'
            ],
            'lsm_narkotika' => [
                'nama' => 'Nama LSM'
            ],
            'media_sosial' => [
                'nama_media_sosial' => 'Nama Media Sosial'
            ],
            'penjual_vape' => [
                'nama' => 'Nama'
            ],
            'perusahaan_farmasi_prekursor' => [
                'nama' => 'Nama Perusahaan'
            ],
            'objek_vital' => [
                'nama' => 'Nama Objek Vital'
            ],
            'penggiat_narkotika' => [
                'nama' => 'Nama'
            ],
            'penginapan' => [
                'nama' => 'Nama Penginapan'
            ],
            'rutan_lapas' => [
                'nama' => 'Nama Rutan/Lapas'
            ],
            'transportasi' => [
                'nama' => 'Nama Transportasi'
            ],
            'ekspedisi' => [
                'nama' => 'Nama Ekspedisi'
            ],
            'lembaga_rehabilitasi' => [
                'nama' => 'Nama Lembaga'
            ]
        ];

        $requiredFields = $requiredFieldsMap[$tableName] ?? [];
        $missingFields = [];

        foreach ($requiredFields as $field => $label) {
            if (!isset($data[$field]) || empty($data[$field]) || trim($data[$field]) === '') {
                $missingFields[] = $label;
            }
        }

        if (!empty($missingFields)) {
            return 'Data tidak lengkap. Field wajib yang kosong: ' . implode(', ', $missingFields) . '. Silakan tolak verifikasi ini dan minta admin untuk melengkapi data.';
        }

        return true;
    }

    /**
     * Process data before saving to handle empty date fields and other data cleaning
     */
    private function processDataForSave($data, $tableName)
    {
        $processedData = $data;

        // Define date fields for each table
        $dateFields = [
            'data_individu_tsk' => [
                'tgl_lahir',
                'tanggal_kasus',
                'tanggal_kasus_proses',
                'tanggal_kasus_narapidana'
            ],
            'thm' => [
                'tanggal_lahir',
                'tanggal_kasus'
            ],
            'lsm_narkotika' => [
                'tanggal_berdiri',
                'tanggal_kasus'
            ],
            'media_sosial' => [
                'tanggal_kasus'
            ],
            'penjual_vape' => [
                'tanggal_lahir',
                'tanggal_kasus'
            ],
            'perusahaan_farmasi_prekursor' => [
                'tanggal_berdiri',
                'tanggal_kasus'
            ],
            'objek_vital' => [
                'tanggal_kasus'
            ],
            'penggiat_narkotika' => [
                'tanggal_lahir',
                'tanggal_kasus'
            ],
            'penginapan' => [
                'tanggal_kasus'
            ],
            'rutan_lapas' => [
                'tanggal_kasus'
            ],
            'transportasi' => [
                'tanggal_kasus'
            ],
            'ekspedisi' => [
                'tanggal_kasus'
            ],
            'lembaga_rehabilitasi' => [
                'tanggal_berdiri',
                'tanggal_kasus'
            ]
        ];

        // Get date fields for current table
        $currentDateFields = $dateFields[$tableName] ?? [];

        // Process each date field
        foreach ($currentDateFields as $field) {
            if (isset($processedData[$field])) {
                $value = $processedData[$field];

                // Convert empty string, null, or invalid dates to null
                if (empty($value) || $value === '' || $value === '0000-00-00' || $value === '0000-00-00 00:00:00') {
                    $processedData[$field] = null;
                } else {
                    // Try to validate and format the date
                    try {
                        $date = \Carbon\Carbon::parse($value);
                        $processedData[$field] = $date->format('Y-m-d');
                    } catch (\Exception $e) {
                        // If parsing fails, set to null
                        $processedData[$field] = null;
                    }
                }
            }
        }

        // Define required fields per table (cannot be null)
        $requiredFields = [
            'data_individu_tsk' => ['nama', 'nik'],
            'thm' => ['nama'],
            'lsm_narkotika' => ['nama'],
            'media_sosial' => ['nama_media_sosial'],
            'penjual_vape' => ['nama'],
            'perusahaan_farmasi_prekursor' => ['nama'],
            'objek_vital' => ['nama'],
            'penggiat_narkotika' => ['nama'],
            'penginapan' => ['nama'],
            'rutan_lapas' => ['nama'],
            'transportasi' => ['nama'],
            'ekspedisi' => ['nama'],
            'lembaga_rehabilitasi' => ['nama']
        ];

        $currentRequiredFields = $requiredFields[$tableName] ?? [];

        // Handle other empty string fields that should be null (except required fields)
        $emptyToNullFields = [
            'nama',
            'nkk',
            'jenis_kelamin',
            'tempat_lahir',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'kelurahan',
            'alamat',
            'nama_ayah',
            'nik_ayah',
            'nama_ibu',
            'nik_ibu',
            'peran_jaringan',
            'modus_operasi',
            'jenis_narkotika',
            'jumlah_barang_bukti',
            'satuan_barang_bukti',
            'status',
            'sumber_informasi'
        ];

        foreach ($emptyToNullFields as $field) {
            // Skip if this is a required field for current table
            if (in_array($field, $currentRequiredFields)) {
                continue;
            }

            if (isset($processedData[$field]) && $processedData[$field] === '') {
                $processedData[$field] = null;
            }
        }

        // For required fields, ensure they have a value (keep empty string if needed for validation)
        foreach ($currentRequiredFields as $field) {
            if (!isset($processedData[$field]) || $processedData[$field] === null || $processedData[$field] === '') {
                // Keep the value as is - will be caught by database validation if truly empty
                // Don't convert to null for required fields
            }
        }

        return $processedData;
    }
}
