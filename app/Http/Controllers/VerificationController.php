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

            if ($verification->data_id == 0) {
                // This is a new record (duplicate detected during creation)
                // Create the new record
                $model = new $modelClass();
                $model->fill($newData);
                $model->save();
            } else {
                // This is an update to existing record
                // Find and update the existing record instead of deleting
                $existingModel = $modelClass::find($verification->data_id);
                if ($existingModel) {
                    // Update the existing record with new data
                    $existingModel->update($newData);
                } else {
                    // If the existing record doesn't exist, create a new one
                    $model = new $modelClass();
                    $model->fill($newData);
                    $model->save();
                }
            }

            // Update verification status
            $verification->status = 'approved';
            $verification->super_admin_id = Auth::id();
            $verification->save();

            DB::commit();

            // Determine redirect based on table type
            $redirectRoute = $this->getEditRouteForTable($verification->table_name, $verification->data_id);

            return redirect($redirectRoute)
                ->with('success', 'Data berhasil disetujui. Data telah diperbarui dan Anda akan diarahkan ke halaman edit.');
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

        return view('super-admin.verification.show', compact('verification', 'tableDisplayName', 'fieldLabels'));
    }

    /**
     * Get the edit route for a specific table and data ID
     */
    private function getEditRouteForTable($tableName, $dataId)
    {
        $routeMap = [
            'data_individu_tsk' => 'admin.data.individu.edit',
            'thm' => 'admin.data.thm.edit',
            'lsm_narkotika' => 'admin.data.lsm.edit',
            'media_sosial' => 'admin.data.medsos.edit',
            'penjual_vape' => 'admin.data.vape.edit',
            'perusahaan_farmasi_prekursor' => 'admin.data.farmasi.edit',
            'objek_vital' => 'admin.data.objek.edit',
            'penggiat_narkotika' => 'admin.data.penggiat.edit',
            'penginapan' => 'admin.data.penginapan.edit',
            'rutan_lapas' => 'admin.data.rutan.edit',
            'transportasi' => 'admin.data.transportasi.edit',
            'ekspedisi' => 'admin.data.ekspedisi.edit',
            'lembaga_rehabilitasi' => 'admin.data.rehabilitasi.edit',
        ];

        $routeName = $routeMap[$tableName] ?? 'super-admin.verification.index';

        if ($dataId && $dataId > 0) {
            return route($routeName, $dataId);
        }

        return route('super-admin.verification.index');
    }
}
