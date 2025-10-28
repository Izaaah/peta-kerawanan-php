<?php

namespace App\Http\Controllers;

use App\Models\ObjekVitalSubtype;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ObjekVitalSubtypeController extends Controller
{
    /**
     * Store a newly created subtype
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis' => 'required|string|max:255',
                'sub_jenis' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            // Check if user is authenticated
            if (!$request->user()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ter-authenticate.'
                ], 401);
            }

            // Generate unique slug
            $slug = ObjekVitalSubtype::generateSlug($request->jenis, $request->sub_jenis);

            // Check if slug already exists
            $existingSubtype = ObjekVitalSubtype::where('slug', $slug)->first();
            if ($existingSubtype) {
                return response()->json([
                    'success' => false,
                    'message' => 'Subjenis ini sudah ada sebelumnya.'
                ], 422);
            }

            $subtype = ObjekVitalSubtype::create([
                'jenis' => $request->jenis,
                'sub_jenis' => $request->sub_jenis,
                'slug' => $slug,
                'description' => $request->description,
                'created_by' => $request->user()->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subjenis berhasil ditambahkan.',
                'data' => [
                    'id' => $subtype->id,
                    'jenis' => $subtype->jenis,
                    'sub_jenis' => $subtype->sub_jenis,
                    'slug' => $subtype->slug,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get subtypes by jenis
     */
    public function getByJenis($jenis)
    {
        $subtypes = ObjekVitalSubtype::getActiveSubtypes($jenis);

        return response()->json([
            'success' => true,
            'data' => $subtypes
        ]);
    }

    /**
     * Get all subtypes
     */
    public function index()
    {
        $subtypes = ObjekVitalSubtype::with('createdBy')
            ->where('is_active', true)
            ->orderBy('jenis')
            ->orderBy('sub_jenis')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subtypes
        ]);
    }

    /**
     * Delete a subtype
     */
    public function destroy($id)
    {
        $subtype = ObjekVitalSubtype::findOrFail($id);

        // Soft delete by setting is_active to false
        $subtype->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Subjenis berhasil dihapus.'
        ]);
    }
}
