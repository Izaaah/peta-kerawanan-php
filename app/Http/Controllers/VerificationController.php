<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVerification;

class VerificationController extends Controller
{
    public function index() {
        $verifications = DataVerification::where('status', 'pending')->get();
        return view('verification.index', compact('verifications'));
    }

    public function approve($id)
    {
        $verification = DataVerification::findOrFail($id);
        $data = json_decode($verification->new_data, true);

        // Update ke tabel utama sesuai table_name
        $modelClass = '\\App\\Models\\' . \Str::studly(\Str::singular($verification->table_name));
        $model = $modelClass::findOrFail($verification->data_id);
        $model->update($data);

        $verification->status = 'approved';
        $verification->super_admin_id = auth()->id();
        $verification->save();

        return redirect()->route('super-admin.verification.index')->with('success', 'Data berhasil diupdate.');
    }

    public function reject($id) {
        $verification = DataVerification::findOrFail($id);
        $verification->status = 'rejected';
        $verification->super_admin_id = auth()->id();
        $verification->save();
        return redirect()->route('super-admin.verification.index')->with('success', 'Data ditolak');
    }
}