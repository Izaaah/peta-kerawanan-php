<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use App\Models\DataIndividuTsk;
use Illuminate\Support\Facades\DB;

class PetaController extends Controller
{
    public function geojson()
    {
        // Coba ambil dari database terlebih dahulu
        // $desaData = DesaGeojson::withCount('dataIndividuTsk')->get();
        $desaData = DesaGeojson::withCount('dataIndividuTsk')->get();

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
                        'jumlah_kasus' => (int) ($desa->data_individu_tsk_count ?? 0),
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

        $countsByDesa = DataIndividuTsk::selectRaw('LOWER(TRIM(desa)) as desa_key, COUNT(*) as total')
    ->groupBy('desa_key')
    ->pluck('total', 'desa_key');

if (isset($data['features']) && is_array($data['features'])) {
    foreach ($data['features'] as &$feature) {
        if (!isset($feature['properties']) || !is_array($feature['properties'])) {
            $feature['properties'] = [];
        }
        $desaName = $feature['properties']['nama_desa'] ?? '';
        $desaKey = strtolower(trim($desaName));
        $feature['properties']['jumlah_kasus'] = (int) ($countsByDesa[$desaKey] ?? 0);
    }
    unset($feature);
}

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

            /**
     * Get kerawanan statistics
     */
    public function getKerawananStats()
    {
        // Debug: Cek apakah ada data desa
        $totalDesa = DesaGeojson::count();

        // Debug: Cek apakah ada data individu (seperti di peta)
        $totalIndividu = DataIndividuTsk::count();

        // Debug: Cek relasi
        $desaDenganIndividu = DesaGeojson::has('dataIndividuTsk')->count();

        // Debug: Cek sample data individu
        $sampleIndividu = DataIndividuTsk::take(3)->get(['kabupaten', 'kecamatan', 'desa']);

        // Debug: Cek apakah nama desa dari individu ada di desa_geojson
        $individuDesaNames = DataIndividuTsk::distinct('desa')->pluck('desa')->toArray();
        $desaNames = DesaGeojson::distinct('nama_desa')->pluck('nama_desa')->toArray();

        // Cek overlap
        $matchingDesa = array_intersect($individuDesaNames, $desaNames);
        $nonMatchingIndividu = array_diff($individuDesaNames, $desaNames);

        $desaData = DesaGeojson::withCount('dataIndividuTsk')->get();

        $tinggiCount = 0;
        $sedangCount = 0;
        $rendahCount = 0;
        $totalCount = 0;

        // Hitung berdasarkan data individu (seperti di peta)
        $individuData = DataIndividuTsk::selectRaw('desa, COUNT(*) as individu_count')
            ->groupBy('desa')
            ->get();

        foreach ($individuData as $individu) {
            $individuCount = $individu->individu_count;
            $totalCount += $individuCount;

            // Sesuaikan dengan logika JavaScript yang menggunakan >5, >3, >2, >1, >0
            if ($individuCount > 5) {
                $tinggiCount++;
            } elseif ($individuCount > 3) {
                $sedangCount++;
            } elseif ($individuCount > 2) {
                $rendahCount++;
            }
        }

        return response()->json([
            'tinggi' => $tinggiCount,
            'sedang' => $sedangCount,
            'rendah' => $rendahCount,
            'total_desa' => $desaData->count(),
            'debug' => [
                'total_desa' => $totalDesa,
                'total_individu' => $totalIndividu,
                'desa_dengan_individu' => $desaDenganIndividu,
                'total_individu_counted' => $totalCount,
                'sample_individu' => $sampleIndividu->toArray(),
                'individu_desa_names' => $individuDesaNames,
                'matching_desa' => array_values($matchingDesa),
                'non_matching_individu' => array_values($nonMatchingIndividu),
                'sample_desa' => $desaData->take(3)->map(function($desa) {
                    return [
                        'nama' => $desa->nama_desa,
                        'individu_count' => $desa->data_individu_tsk_count,
                        'has_relation' => $desa->dataIndividuTsk()->exists()
                    ];
                })->toArray()
            ]
        ]);
    }
}
