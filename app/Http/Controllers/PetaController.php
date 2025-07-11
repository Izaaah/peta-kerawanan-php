<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use Illuminate\Support\Facades\DB;

class PetaController extends Controller
{
    public function geojson()
    {
        // Coba ambil dari database terlebih dahulu
        $desaData = DesaGeojson::withCount('kasusNarkoba')->get();

        if ($desaData->count() > 0) {
            // Gunakan data dari database
            $features = [];

            foreach ($desaData as $desa) {
                $features[] = [
                    'type' => 'Feature',
                    'properties' => [
                        'id' => $desa->id,
                        'nama_desa' => $desa->nama_desa,
                        'kecamatan' => $desa->kecamatan,
                        'kabupaten' => $desa->kabupaten,
                        'kasus_count' => $desa->kasus_narkoba_count,
                        'kerawanan_level' => $this->getKerawananLevel($desa->kasus_narkoba_count)
                    ],
                    'geometry' => $desa->geometry
                ];
            }

            $geojson = [
                'type' => 'FeatureCollection',
                'features' => $features
            ];

            return response()->json($geojson, 200, [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]);
        }

        // Fallback ke file GeoJSON jika database kosong
        $path = public_path('geojson/desa-jatim.geojson');

        if (!File::exists($path)) {
            return response()->json([
                'error' => 'File GeoJSON tidak ditemukan',
                'message' => 'Pastikan file desa-jatim.geojson ada di folder public/geojson/'
            ], 404);
        }

        $content = File::get($path);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'error' => 'File GeoJSON tidak valid',
                'message' => 'Format JSON tidak sesuai standar'
            ], 400);
        }

        return response()->json($data, 200, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }

    /**
     * Get kerawanan level based on kasus count
     */
    private function getKerawananLevel($kasusCount)
    {
        if ($kasusCount == 0) return 'Rendah';
        if ($kasusCount <= 5) return 'Sedang';
        if ($kasusCount <= 15) return 'Tinggi';
        return 'Sangat Tinggi';
    }

    /**
     * Get desa statistics
     */
    public function getDesaStats()
    {
        $stats = [
            'total_desa' => DesaGeojson::count(),
            'desa_dengan_kasus' => DesaGeojson::has('kasusNarkoba')->count(),
            'total_kasus' => KasusNarkoba::count(),
            'kabupaten_count' => DesaGeojson::distinct('kabupaten')->count(),
            'kecamatan_count' => DesaGeojson::distinct('kecamatan')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Get desa by kabupaten
     */
    public function getDesaByKabupaten($kabupaten)
    {
        $desa = DesaGeojson::where('kabupaten', $kabupaten)
            ->withCount('kasusNarkoba')
            ->get();

        return response()->json($desa);
    }

    /**
     * Get desa detail with kasus
     */
    public function getDesaDetail($id)
    {
        $desa = DesaGeojson::with('kasusNarkoba')->find($id);

        if (!$desa) {
            return response()->json(['error' => 'Desa tidak ditemukan'], 404);
        }

        return response()->json($desa);
    }
}
