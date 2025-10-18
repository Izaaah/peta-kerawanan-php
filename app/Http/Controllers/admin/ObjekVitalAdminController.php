<?php

namespace App\Http\Controllers\admin;

use App\Models\ObjekVital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;
use App\Models\ObjekVitalSubtype;
use Illuminate\Support\Facades\Log;

class ObjekVitalAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Collect data from all sources
        $allData = collect();

        // Get ObjekVital data
        $objekVitalQuery = \App\Models\ObjekVital::query();
        if (!$user->isSuperAdmin()) {
            $objekVitalQuery->where('created_by', $user->id);
        }
        $objekVitalData = $objekVitalQuery->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_objek' => $item->nama_objek,
                'nama_manager' => $item->nama_manager,
                'lokasi' => $item->lokasi,
                'no_hp' => $item->no_hp,
                'jenis' => $item->jenis ?? 'Instalasi dan Bangunan',
                'sub_jenis' => $item->sub_jenis ?? 'Objek Vital',
                'created_at' => $item->created_at,
                'source' => 'objekvital',
                'route_show' => 'admin.data.objekvital.show',
                'route_edit' => 'admin.data.objekvital.edit',
                'route_destroy' => 'admin.data.objekvital.destroy'
            ];
        });
        $allData = $allData->merge($objekVitalData);

        // Get Penginapan data
        $penginapanQuery = \App\Models\Penginapan::query();
        if (!$user->isSuperAdmin()) {
            $penginapanQuery->where('created_by', $user->id);
        }
        $penginapanData = $penginapanQuery->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_objek' => $item->nama,
                'nama_manager' => $item->nama_pengelola,
                'lokasi' => $item->lokasi,
                'no_hp' => $item->no_hp,
                'jenis' => 'Instalasi dan Bangunan',
                'sub_jenis' => 'Penginapan (' . $item->jenis . ')',
                'created_at' => $item->created_at,
                'source' => 'penginapan',
                'route_show' => 'admin.data.penginapan.show',
                'route_edit' => 'admin.data.penginapan.edit',
                'route_destroy' => 'admin.data.penginapan.destroy'
            ];
        });
        $allData = $allData->merge($penginapanData);

        // Get THM data
        $thmQuery = \App\Models\Thm::query();
        if (!$user->isSuperAdmin()) {
            $thmQuery->where('created_by', $user->id);
        }
        $thmData = $thmQuery->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_objek' => $item->nama_thm,
                'nama_manager' => $item->ketua_thm,
                'lokasi' => $item->alamat,
                'no_hp' => $item->no_hp_ketua,
                'jenis' => 'Instalasi dan Bangunan',
                'sub_jenis' => 'THM',
                'created_at' => $item->created_at,
                'source' => 'thm',
                'route_show' => 'admin.data.thm.show',
                'route_edit' => 'admin.data.thm.edit',
                'route_destroy' => 'admin.data.thm.destroy'
            ];
        });
        $allData = $allData->merge($thmData);

        // Get Vape data
        $vapeQuery = \App\Models\PenjualVape::query();
        if (!$user->isSuperAdmin()) {
            $vapeQuery->where('created_by', $user->id);
        }
        $vapeData = $vapeQuery->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_objek' => $item->nama_toko,
                'nama_manager' => $item->pemilik,
                'lokasi' => $item->lokasi,
                'no_hp' => $item->no_hp,
                'jenis' => 'Instalasi dan Bangunan',
                'sub_jenis' => 'Vape',
                'created_at' => $item->created_at,
                'source' => 'vape',
                'route_show' => 'admin.data.vape.show',
                'route_edit' => 'admin.data.vape.edit',
                'route_destroy' => 'admin.data.vape.destroy'
            ];
        });
        $allData = $allData->merge($vapeData);

        // Apply search filter
        if ($request->filled('q')) {
            $q = $request->q;
            $allData = $allData->filter(function ($item) use ($q) {
                return stripos($item['nama_objek'], $q) !== false ||
                    stripos($item['nama_manager'], $q) !== false ||
                    stripos($item['lokasi'], $q) !== false ||
                    stripos($item['no_hp'], $q) !== false ||
                    stripos($item['sub_jenis'], $q) !== false;
            });
        }

        // Sort by created_at desc
        $allData = $allData->sortByDesc('created_at');

        // Paginate manually
        $perPage = 10;
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = $allData->slice($offset, $perPage)->values();

        // Create paginator
        $objekVitalList = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $allData->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'pageName' => 'page',
            ]
        );
        $objekVitalList->withQueryString();

        return view('admin.data.objekvital.index', compact('objekVitalList'));
    }

    public function create()
    {
        return view('admin.data.objekvital.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $createdData = [];

        try {
            // Debug: Log request data
            Log::info('ObjekVital Store Request:', [
                'user_id' => $user->id,
                'request_data' => $request->all()
            ]);

            // Validate required fields
            $this->validateRequiredFields($request);

            // Handle Industri data
            if ($request->has('industri')) {
                $createdData = array_merge($createdData, $this->processIndustriData($request->input('industri'), $user));
            }

            // Handle Pertambangan data
            if ($request->has('pertambangan')) {
                $createdData = array_merge($createdData, $this->processPertambanganData($request->input('pertambangan'), $user));
            }

            // Handle Perhubungan data
            if ($request->has('perhubungan')) {
                $createdData = array_merge($createdData, $this->processPerhubunganData($request->input('perhubungan'), $user));
            }

            // Handle Instalasi data
            if ($request->has('instalasi')) {
                $createdData = array_merge($createdData, $this->processInstalasiData($request->input('instalasi'), $user));
            }

            // Handle Perbankan data
            if ($request->has('perbankan')) {
                $createdData = array_merge($createdData, $this->processPerbankanData($request->input('perbankan'), $user));
            }

            // Handle Lembaga Negara data
            if ($request->has('lembaga_negara')) {
                $createdData = array_merge($createdData, $this->processLembagaNegaraData($request->input('lembaga_negara'), $user));
            }

            if (empty($createdData)) {
                return redirect()->back()->with('error', 'Tidak ada data yang disimpan. Pastikan minimal satu jenis data diisi dengan benar.');
            }

            $count = count($createdData);
            Log::info('ObjekVital Store Success:', [
                'user_id' => $user->id,
                'created_count' => $count,
                'created_data' => $createdData
            ]);

            return redirect()->route('admin.data.objekvital.index')
                ->with('success', "Berhasil menyimpan {$count} data objek vital.");
        } catch (\Exception $e) {
            Log::error('ObjekVital Store Error:', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Validate required fields for each data type
     */
    private function validateRequiredFields(Request $request)
    {
        $hasData = false;
        $errors = [];

        // Check each data type
        $dataTypes = ['industri', 'pertambangan', 'perhubungan', 'instalasi', 'perbankan', 'lembaga_negara'];

        foreach ($dataTypes as $type) {
            if ($request->has($type)) {
                $data = $request->input($type);

                // Check if this data type has any meaningful content
                $hasMeaningfulData = false;
                foreach ($data as $key => $value) {
                    if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                        $hasMeaningfulData = true;
                        break;
                    }
                }

                // Only validate if this data type has meaningful content
                if ($hasMeaningfulData) {
                    $hasData = true;

                    // Check if any nama field is filled
                    $hasNama = false;
                    foreach ($data as $key => $value) {
                        if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                            $hasNama = true;

                            // Validate nama_objek
                            if (strlen(trim($value)) < 2) {
                                $errors[] = "Nama objek untuk {$type} terlalu pendek (minimal 2 karakter).";
                            }

                            // Check corresponding manager field
                            $typeKey = str_replace('_nama', '', $key);
                            $managerKey = $typeKey . '_manager';
                            $pengelolaKey = $typeKey . '_pengelola';
                            $ketuaKey = $typeKey . '_ketua';
                            $pemilikKey = $typeKey . '_pemilik';

                            $managerValue = $data[$managerKey] ?? $data[$pengelolaKey] ?? $data[$ketuaKey] ?? $data[$pemilikKey] ?? '';

                            if (empty(trim($managerValue))) {
                                $errors[] = "Nama manager/pengelola untuk {$type} harus diisi.";
                            }

                            // Check phone number
                            $phoneKey = $typeKey . '_no_hp';
                            $phoneValue = $data[$phoneKey] ?? '';

                            if (empty(trim($phoneValue))) {
                                $errors[] = "Nomor HP untuk {$type} harus diisi.";
                            } elseif (!preg_match('/^[0-9+\-\s()]+$/', $phoneValue)) {
                                $errors[] = "Format nomor HP untuk {$type} tidak valid.";
                            }
                        }
                    }

                    if (!$hasNama) {
                        $errors[] = "Minimal satu nama objek untuk {$type} harus diisi.";
                    }
                }
            }
        }

        if (!$hasData) {
            $errors[] = "Minimal satu jenis data harus diisi.";
        }

        if (!empty($errors)) {
            throw new \Exception(implode(' ', $errors));
        }
    }

    /**
     * Process Industri data
     */
    private function processIndustriData($data, $user)
    {
        $createdData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                $type = str_replace('_nama', '', $key);
                $subJenis = $this->getSubJenisName('Industri', $type, $data, $user);

                $objekData = [
                    'nama_objek' => trim($value),
                    'nama_manager' => trim($data[$type . '_manager'] ?? ''),
                    'no_hp' => trim($data[$type . '_no_hp'] ?? ''),
                    'bidang' => trim($data[$type . '_bidang'] ?? ''),
                    'jenis' => 'Industri',
                    'sub_jenis' => $subJenis,
                    'lokasi' => $this->buildLocationString($data),
                    'created_by' => $user->id,
                ];
                $createdData[] = ObjekVital::create($objekData);
            }
        }
        return $createdData;
    }

    /**
     * Process Pertambangan data
     */
    private function processPertambanganData($data, $user)
    {
        $createdData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                $type = str_replace('_nama', '', $key);
                $subJenis = $this->getSubJenisName('Pertambangan dan Energi', $type, $data, $user);

                $objekData = [
                    'nama_objek' => trim($value),
                    'nama_manager' => trim($data[$type . '_manager'] ?? ''),
                    'no_hp' => trim($data[$type . '_no_hp'] ?? ''),
                    'bidang' => trim($data[$type . '_bidang'] ?? ''),
                    'jenis' => 'Pertambangan dan Energi',
                    'sub_jenis' => $subJenis,
                    'lokasi' => $this->buildLocationString($data),
                    'created_by' => $user->id,
                ];
                $createdData[] = ObjekVital::create($objekData);
            }
        }
        return $createdData;
    }

    /**
     * Process Perhubungan data
     */
    private function processPerhubunganData($data, $user)
    {
        $createdData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                $type = str_replace('_nama', '', $key);
                $subJenis = $this->getSubJenisName('Perhubungan', $type, $data, $user);

                $objekData = [
                    'nama_objek' => trim($value),
                    'nama_manager' => trim($data[$type . '_manager'] ?? ''),
                    'no_hp' => trim($data[$type . '_no_hp'] ?? ''),
                    'bidang' => trim($data[$type . '_bidang'] ?? ''),
                    'jenis' => 'Perhubungan',
                    'sub_jenis' => $subJenis,
                    'lokasi' => $this->buildLocationString($data),
                    'created_by' => $user->id,
                ];
                $createdData[] = ObjekVital::create($objekData);
            }
        }
        return $createdData;
    }

    /**
     * Process Instalasi data
     */
    private function processInstalasiData($data, $user)
    {
        $createdData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                $type = str_replace('_nama', '', $key);
                $subJenis = $this->getSubJenisName('Instalasi dan Bangunan', $type, $data, $user);

                $objekData = [
                    'nama_objek' => trim($value),
                    'nama_manager' => trim($data[$type . '_manager'] ?? $data[$type . '_pengelola'] ?? $data[$type . '_ketua'] ?? $data[$type . '_pemilik'] ?? ''),
                    'no_hp' => trim($data[$type . '_no_hp'] ?? ''),
                    'bidang' => trim($data[$type . '_bidang'] ?? ''),
                    'jenis' => 'Instalasi dan Bangunan',
                    'sub_jenis' => $subJenis,
                    'lokasi' => $this->buildLocationString($data),
                    'created_by' => $user->id,
                ];
                $createdData[] = ObjekVital::create($objekData);
            }
        }
        return $createdData;
    }

    /**
     * Process Perbankan data
     */
    private function processPerbankanData($data, $user)
    {
        $createdData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                $type = str_replace('_nama', '', $key);
                $subJenis = $this->getSubJenisName('Perbankan dan Keuangan', $type, $data, $user);

                $objekData = [
                    'nama_objek' => trim($value),
                    'nama_manager' => trim($data[$type . '_manager'] ?? $data[$type . '_ketua'] ?? ''),
                    'no_hp' => trim($data[$type . '_no_hp'] ?? ''),
                    'bidang' => trim($data[$type . '_bidang'] ?? ''),
                    'jenis' => 'Perbankan dan Keuangan',
                    'sub_jenis' => $subJenis,
                    'lokasi' => $this->buildLocationString($data),
                    'created_by' => $user->id,
                ];
                $createdData[] = ObjekVital::create($objekData);
            }
        }
        return $createdData;
    }

    /**
     * Process Lembaga Negara data
     */
    private function processLembagaNegaraData($data, $user)
    {
        $createdData = [];
        foreach ($data as $key => $value) {
            if (strpos($key, '_nama') !== false && !empty(trim($value))) {
                $type = str_replace('_nama', '', $key);
                $subJenis = $this->getSubJenisName('Lembaga Negara', $type, $data, $user);

                $objekData = [
                    'nama_objek' => trim($value),
                    'nama_manager' => trim($data[$type . '_manager'] ?? $data[$type . '_menteri'] ?? $data[$type . '_ketua'] ?? $data[$type . '_kepala'] ?? ''),
                    'no_hp' => trim($data[$type . '_no_hp'] ?? ''),
                    'bidang' => trim($data[$type . '_bidang'] ?? $data[$type . '_fungsi'] ?? $data[$type . '_tugas'] ?? ''),
                    'jenis' => 'Lembaga Negara',
                    'sub_jenis' => $subJenis,
                    'lokasi' => $this->buildLocationString($data),
                    'created_by' => $user->id,
                ];
                $createdData[] = ObjekVital::create($objekData);
            }
        }
        return $createdData;
    }

    /**
     * Get subjenis name from database or create from type
     */
    private function getSubJenisName($jenis, $type, $data, $user = null)
    {
        // Check if this is a custom subtype (has custom_subjenis field)
        if (isset($data['custom_subjenis_' . $type]) && !empty(trim($data['custom_subjenis_' . $type]))) {
            $customSubJenis = trim($data['custom_subjenis_' . $type]);

            // Try to find existing subtype
            $existingSubtype = ObjekVitalSubtype::where('jenis', $jenis)
                ->where('sub_jenis', $customSubJenis)
                ->where('is_active', true)
                ->first();

            if ($existingSubtype) {
                return $existingSubtype->sub_jenis;
            }

            // Create new subtype if not exists
            $slug = ObjekVitalSubtype::generateSlug($jenis, $customSubJenis);
            ObjekVitalSubtype::create([
                'jenis' => $jenis,
                'sub_jenis' => $customSubJenis,
                'slug' => $slug,
                'created_by' => $user ? $user->id : null,
            ]);

            return $customSubJenis;
        }

        // Default fallback
        return ucfirst(str_replace('_', ' ', $type));
    }

    /**
     * Build location string from form data
     */
    private function buildLocationString($data)
    {
        $locationParts = [];
        if (isset($data['provinsi']) && $data['provinsi'] === 'Jawa Timur') {
            if (!empty($data['kabupaten'])) {
                $locationParts[] = $data['kabupaten'];
            }
            if (!empty($data['kecamatan'])) {
                $locationParts[] = $data['kecamatan'];
            }
            if (!empty($data['kelurahan'])) {
                $locationParts[] = $data['kelurahan'];
            }
        }
        // Handle other provinces
        elseif (isset($data['provinsi']) && $data['provinsi'] === 'lainnya') {
            if (!empty($data['provinsi_lain'])) {
                $locationParts[] = $data['provinsi_lain'];
            }
            if (!empty($data['kabupaten_lain'])) {
                $locationParts[] = $data['kabupaten_lain'];
            }
            if (!empty($data['kecamatan_lain'])) {
                $locationParts[] = $data['kecamatan_lain'];
            }
            if (!empty($data['kelurahan_lain'])) {
                $locationParts[] = $data['kelurahan_lain'];
            }
        }

        // Add detailed address if available
        if (!empty($data['alamat'])) {
            $locationParts[] = $data['alamat'];
        }

        return implode(', ', array_filter($locationParts));
    }

    public function show($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('admin.data.objekvital.show', compact('objekVital'));
    }

    public function edit($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('admin.data.objekvital.edit', compact('objekVital'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_objek' => 'required|string|max:255',
            'nama_manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->update($request->all());
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil diupdate.');
    }

    public function destroy($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->delete();
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama_objek,nama_manager,lokasi,no_hp\n";

        // Set headers for download
        $filename = 'import_objekvital.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        // Output CSV content
        echo $csvContent;
        exit;
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        try {
            $file = $request->file('file');
            $handle = fopen($file->getPathname(), 'r');

            if (!$handle) {
                throw new \Exception('Tidak dapat membaca file');
            }

            $importedCount = 0;
            $duplicateCount = 0;
            $rowNumber = 0;

            while (($data = fgetcsv($handle)) !== false) {
                $rowNumber++;

                // Skip header row (row 1) and empty rows
                if ($rowNumber == 1 || empty(array_filter($data))) {
                    continue;
                }

                // Validate data structure
                if (count($data) < 4) {
                    continue;
                }

                $objekVitalData = [
                    'nama_objek' => trim($data[0] ?? ''),
                    'nama_manager' => trim($data[1] ?? ''),
                    'lokasi' => trim($data[2] ?? ''),
                    'no_hp' => trim($data[3] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (
                    empty($objekVitalData['nama_objek']) || empty($objekVitalData['nama_manager']) ||
                    empty($objekVitalData['lokasi']) || empty($objekVitalData['no_hp'])
                ) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'objek_vital',
                    $objekVitalData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    ObjekVital::create($objekVitalData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data objek vital.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
