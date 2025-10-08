<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use App\Models\DataIndividuTsk;
use App\Models\TkpResidivisIndividu;
use Illuminate\Support\Facades\DB;

class PetaController extends Controller
{
    public function geojson()
    {
        // Ambil dari database terlebih dahulu
        $desaData = DesaGeojson::withCount('dataIndividuTsk')->get();

        if ($desaData->count() > 0) {
            // Jika FK desa_geojson_id belum terisi, fallback hitung berdasarkan nama (kelurahan)
            // Perbaikan: gunakan kombinasi kabupaten, kecamatan, dan kelurahan untuk menghindari konflik nama
            $countsByKelurahan = DataIndividuTsk::selectRaw('
                LOWER(TRIM(kabupaten)) as kab_key,
                LOWER(TRIM(kecamatan)) as kec_key,
                LOWER(TRIM(kelurahan)) as kel_key,
                COUNT(*) as total
            ')
                ->groupBy('kab_key', 'kec_key', 'kel_key')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->kab_key . '|' . $item->kec_key . '|' . $item->kel_key => $item->total];
                });

            $features = [];

            foreach ($desaData as $desa) {
                $byFk = (int) ($desa->data_individu_tsk_count ?? 0);
                $kabKey = strtolower(trim($desa->kabupaten));
                $kecKey = strtolower(trim($desa->kecamatan));
                $kelKey = strtolower(trim($desa->nama_desa));
                $combinedKey = $kabKey . '|' . $kecKey . '|' . $kelKey;
                $byName = (int) ($countsByKelurahan[$combinedKey] ?? 0);
                $jumlahKasus = max($byFk, $byName);

                $features[] = [
                    'type' => 'Feature',
                    'properties' => [
                        'id' => $desa->id,
                        'nama_desa' => $desa->nama_desa,
                        'kecamatan' => $desa->kecamatan,
                        'kabupaten' => $desa->kabupaten,
                        'jumlah_kasus' => $jumlahKasus,
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

        // Perkaya fitur dengan jumlah_kasus dari DataIndividuTsk (mapping nama_desa ~ kelurahan)
        // Perbaikan: gunakan kombinasi kabupaten, kecamatan, dan kelurahan untuk menghindari konflik nama
        $countsByKelurahan = DataIndividuTsk::selectRaw('
            LOWER(TRIM(kabupaten)) as kab_key,
            LOWER(TRIM(kecamatan)) as kec_key,
            LOWER(TRIM(kelurahan)) as kel_key,
            COUNT(*) as total
        ')
            ->groupBy('kab_key', 'kec_key', 'kel_key')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kab_key . '|' . $item->kec_key . '|' . $item->kel_key => $item->total];
            });

        if (isset($data['features']) && is_array($data['features'])) {
            foreach ($data['features'] as &$feature) {
                if (!isset($feature['properties']) || !is_array($feature['properties'])) {
                    $feature['properties'] = [];
                }
                $desaName = $feature['properties']['nama_desa'] ?? '';
                $kecamatan = $feature['properties']['kecamatan'] ?? '';
                $kabupaten = $feature['properties']['kabupaten'] ?? '';

                $kabKey = strtolower(trim($kabupaten));
                $kecKey = strtolower(trim($kecamatan));
                $kelKey = strtolower(trim($desaName));
                $combinedKey = $kabKey . '|' . $kecKey . '|' . $kelKey;

                $feature['properties']['jumlah_kasus'] = (int) ($countsByKelurahan[$combinedKey] ?? 0);
            }
            unset($feature);
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
        try {
            // Debug: Cek apakah ada data desa
            $totalDesa = DesaGeojson::count();

            // Debug: Cek apakah ada data individu (seperti di peta)
            $totalIndividu = DataIndividuTsk::count();

            // Debug: Cek relasi
            $desaDenganIndividu = DesaGeojson::has('dataIndividuTsk')->count();

            // Debug: Sample data individu (kolom yang ada)
            $sampleIndividu = DataIndividuTsk::take(3)->get(['kabupaten', 'kecamatan', 'kelurahan']);

            // Hitung per desa berdasarkan FK desa_geojson_id
            $individuPerDesa = DataIndividuTsk::selectRaw('desa_geojson_id, COUNT(*) as individu_count')
                ->whereNotNull('desa_geojson_id')
                ->groupBy('desa_geojson_id')
                ->pluck('individu_count', 'desa_geojson_id');

            $tinggiCount = 0;
            $sedangCount = 0;
            $rendahCount = 0;
            $totalCount = $individuPerDesa->sum();

            foreach ($individuPerDesa as $count) {
                if ($count > 5) {
                    $tinggiCount++;
                } elseif ($count > 3) {
                    $sedangCount++;
                } elseif ($count > 2) {
                    $rendahCount++;
                }
            }

            // Sample desa untuk debug
            $desaData = DesaGeojson::withCount('dataIndividuTsk')->take(3)->get();

            return response()->json([
                'tinggi' => $tinggiCount,
                'sedang' => $sedangCount,
                'rendah' => $rendahCount,
                'total_desa' => $totalDesa,
                'debug' => [
                    'total_desa' => $totalDesa,
                    'total_individu' => $totalIndividu,
                    'desa_dengan_individu' => $desaDenganIndividu,
                    'total_individu_counted' => $totalCount,
                    'sample_individu' => $sampleIndividu->toArray(),
                    'sample_desa' => $desaData->map(function ($desa) {
                        return [
                            'nama' => $desa->nama_desa,
                            'individu_count' => $desa->data_individu_tsk_count,
                            'has_relation' => $desa->dataIndividuTsk()->exists()
                        ];
                    })->toArray()
                ]
            ], 200, ['Content-Type' => 'application/json']);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500, ['Content-Type' => 'application/json']);
        }
    }

    public function geojsonTkp()
    {
        $desaData = DesaGeojson::all();

        // Perbaikan: gunakan kombinasi kabupaten, kecamatan, dan desa untuk menghindari konflik nama
        $countsByDesa = TkpResidivisIndividu::selectRaw('
        LOWER(TRIM(kabupaten)) as kab_key,
        LOWER(TRIM(kecamatan)) as kec_key,
        LOWER(TRIM(desa)) as desa_key,
        COUNT(*) as total
    ')
            ->groupBy('kab_key', 'kec_key', 'desa_key')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kab_key . '|' . $item->kec_key . '|' . $item->desa_key => $item->total];
            });

        $features = [];
        foreach ($desaData as $desa) {
            $kabKey = strtolower(trim($desa->kabupaten));
            $kecKey = strtolower(trim($desa->kecamatan));
            $desaKey = strtolower(trim($desa->nama_desa));
            $combinedKey = $kabKey . '|' . $kecKey . '|' . $desaKey;
            $jumlahKasus = (int) ($countsByDesa[$combinedKey] ?? 0);
            $features[] = [
                'type' => 'Feature',
                'properties' => [
                    'id' => $desa->id,
                    'nama_desa' => $desa->nama_desa,
                    'kecamatan' => $desa->kecamatan,
                    'kabupaten' => $desa->kabupaten,
                    'jumlah_kasus' => $jumlahKasus,
                ],
                'geometry' => $desa->geometry
            ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ], 200, ['Content-Type' => 'application/json']);
    }

    public function getKerawananStatsTkp()
    {
        try {
            $totalDesa = DesaGeojson::count();

            $tkpPerDesa = TkpResidivisIndividu::selectRaw('LOWER(TRIM(desa)) as desa_key, COUNT(*) as total')
                ->groupBy('desa_key')
                ->pluck('total', 'desa_key');

            $tinggi = 0;
            $sedang = 0;
            $rendah = 0;
            $totalCount = $tkpPerDesa->sum();
            foreach ($tkpPerDesa as $count) {
                if ($count > 100) $tinggi++;
                elseif ($count > 50) $sedang++;
                elseif ($count > 20) $rendah++;
            }

            return response()->json([
                'tinggi' => $tinggi,
                'sedang' => $sedang,
                'rendah' => $rendah,
                'total_desa' => $totalDesa,
                'debug' => [
                    'total_tkp' => $totalCount,
                ]
            ], 200, ['Content-Type' => 'application/json']);
        } catch (\Throwable $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
