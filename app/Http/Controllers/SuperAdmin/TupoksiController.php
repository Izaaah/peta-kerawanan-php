<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TupoksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tugas = Tugas::all();
        $fungsi = Fungsi::all();

        return view('super-admin.tupoksi.index', compact('tugas', 'fungsi'));
    }

    /**
     * Store a newly created tugas resource in storage.
     */
    public function storeTugas(Request $request)
    {
        $request->validate([
            'pasal' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            Tugas::create([
                'pasal' => $request->pasal,
                'isi' => $request->isi,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tugas pokok berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created fungsi resource in storage.
     */
    public function storeFungsi(Request $request)
    {
        $request->validate([
            'fungsi_isi' => 'required|array',
            'fungsi_isi.*' => 'required|string',
            'fungsi_id' => 'sometimes|array',
            'fungsi_id.*' => 'sometimes|integer|exists:fungsi,id',
        ]);

        try {
            DB::beginTransaction();

            $fungsiIsi = $request->fungsi_isi;
            $fungsiIds = $request->fungsi_id ?? [];

            foreach ($fungsiIsi as $index => $isi) {
                $fungsiId = $fungsiIds[$index] ?? null;

                if ($fungsiId) {
                    // Update existing function
                    $fungsi = Fungsi::findOrFail($fungsiId);
                    $fungsi->update(['isi' => $isi]);
                } else {
                    // Create new function
                    Fungsi::create(['isi' => $isi]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Fungsi berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified tugas resource in storage.
     */
    public function updateTugas(Request $request, $id)
    {
        $request->validate([
            'pasal' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $tugas = Tugas::findOrFail($id);
            $tugas->update([
                'pasal' => $request->pasal,
                'isi' => $request->isi,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tugas pokok berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified fungsi resource in storage.
     */
    public function updateFungsi(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $fungsi = Fungsi::findOrFail($id);
            $fungsi->update([
                'isi' => $request->isi,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Fungsi berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified tugas resource from storage.
     */
    public function destroyTugas($id)
    {
        try {
            DB::beginTransaction();

            $tugas = Tugas::findOrFail($id);
            $tugas->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tugas pokok berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified fungsi resource from storage.
     */
    public function destroyFungsi($id)
    {
        try {
            DB::beginTransaction();

            $fungsi = Fungsi::findOrFail($id);
            $fungsi->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Fungsi berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get tugas data for editing
     */
    public function getTugas($id = null)
    {
        try {
            if ($id) {
                $tugas = Tugas::findOrFail($id);
                return response()->json([
                    'success' => true,
                    'data' => $tugas
                ]);
            } else {
                $tugas = Tugas::all();
                return response()->json([
                    'success' => true,
                    'data' => $tugas
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Get fungsi data for editing
     */
    public function getFungsi($id = null)
    {
        try {
            if ($id) {
                $fungsi = Fungsi::findOrFail($id);
                return response()->json([
                    'success' => true,
                    'data' => $fungsi
                ]);
            } else {
                $fungsi = Fungsi::all();
                return response()->json([
                    'success' => true,
                    'data' => $fungsi
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
}
