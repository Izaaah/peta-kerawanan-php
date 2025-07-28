<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVerification;
use App\Services\DuplicateDetectionService;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    public function index() {
        $verifications = DataVerification::where('status', 'pending')
            ->with('admin')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('verification.index', compact('verifications'));
    }

    public function approve($id)
    {
        $verification = DataVerification::findOrFail($id);
        
        try {
            DB::beginTransaction();
            
            $oldData = $verification->old_data_array;
            $newData = $verification->new_data_array;
            
            // Get model class
            $modelClass = '\\App\\Models\\' . \Str::studly(\Str::singular($verification->table_name));
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
                $model = $modelClass::find($verification->data_id);
                if (!$model) {
                    return redirect()->back()->with('error', 'Data lama tidak ditemukan.');
                }
                $model->update($newData);
            }

            // Update verification status
            $verification->status = 'approved';
            $verification->super_admin_id = auth()->id();
            $verification->save();

            DB::commit();

            return redirect()->route('super-admin.verification.index')
                ->with('success', 'Data berhasil disetujui dan disimpan.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Approve verifikasi gagal: '.$e->getMessage(), [
                'verification_id' => $id,
                'data' => $newData,
            ]);
            return redirect()->back()->with('error', 'Gagal memverifikasi data: '.$e->getMessage());
        }
    }

    public function reject($id) {
        $verification = DataVerification::findOrFail($id);
        
        try {
            $verification->status = 'rejected';
            $verification->super_admin_id = auth()->id();
            $verification->save();
            
            return redirect()->route('super-admin.verification.index')
                ->with('success', 'Data ditolak');
        } catch (\Exception $e) {
            \Log::error('Reject verifikasi gagal: '.$e->getMessage(), [
                'verification_id' => $id,
            ]);
            return redirect()->back()->with('error', 'Gagal menolak data: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        $verification = DataVerification::with('admin')->findOrFail($id);
        $tableDisplayName = DuplicateDetectionService::getTableDisplayName($verification->table_name);
        $fieldLabels = DuplicateDetectionService::getFieldLabels($verification->table_name);
        
        return view('verification.show', compact('verification', 'tableDisplayName', 'fieldLabels'));
    }
}