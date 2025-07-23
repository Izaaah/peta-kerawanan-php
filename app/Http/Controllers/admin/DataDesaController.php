<?php

namespace App\Http\Controllers\admin;

use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataDesaController extends Controller
{
    public function index(Request $request)
    {
        $kabupatenList = \App\Models\DesaGeojson::select('kabupaten')->distinct()->pluck('kabupaten');

        $query = \App\Models\DesaGeojson::query();
        $query->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
              ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
              ->where('nama_desa', 'not like', '%/%')
              ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
              ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
              ->where('kecamatan', 'not like', '%/%')
              ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
              ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
              ->where('kabupaten', 'not like', '%/%');

        $desaList = $query->get();

        // Statistik berdasarkan hasil filter
        $stats = [
            'total_desa' => $desaList->count(),
            'desa_dengan_kasus' => $desaList->filter(function($desa) { return $desa->kasusNarkoba()->count() > 0; })->count(),
            'total_kasus' => $desaList->sum(function($desa) { return $desa->kasusNarkoba()->count(); }),
            'kabupaten_count' => $desaList->pluck('kabupaten')->unique()->count(),
            'kecamatan_count' => $desaList->pluck('kecamatan')->unique()->count(),
        ];

        return view('super-admin.data.desa', compact('stats', 'kabupatenList', 'desaList'));
    }

    public function getData(Request $request)
    {
        $query = DesaGeojson::withCount('kasusNarkoba');

        // Apply filters
        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }

        if ($request->filled('kerawanan')) {
            // Filter by kerawanan level
            switch($request->kerawanan) {
                case 'Rendah':
                    $query->where('kasus_narkoba_count', 0);
                    break;
                case 'Sedang':
                    $query->whereBetween('kasus_narkoba_count', [1, 5]);
                    break;
                case 'Tinggi':
                    $query->whereBetween('kasus_narkoba_count', [6, 15]);
                    break;
                case 'Sangat Tinggi':
                    $query->where('kasus_narkoba_count', '>', 15);
                    break;
            }
        }

        $perPage = $request->get('per_page', 15);
        $data = $query->paginate($perPage);

        return response()->json($data);
    }

    public function detail($id)
    {
        $desa = DesaGeojson::with(['kasusNarkoba' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($id);

        if (!$desa) {
            return response()->json(['error' => 'Desa tidak ditemukan'], 404);
        }

        // Get additional statistics
        $stats = [
            'total_kasus' => $desa->kasusNarkoba->count(),
            'kasus_terbaru' => $desa->kasusNarkoba->first(),
            'kerawanan_level' => $desa->kerawanan_level,
            'kerawanan_color' => $desa->kerawanan_color,
        ];

        return response()->json([
            'desa' => $desa,
            'stats' => $stats
        ]);
    }

    public function export(Request $request)
    {
        $query = DesaGeojson::withCount('kasusNarkoba');

        // Apply same filters as getData
        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }

        $data = $query->get();

        $filename = 'data_desa_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, [
                'ID', 'Nama Desa', 'Kecamatan', 'Kabupaten',
                'Jumlah Kasus', 'Tingkat Kerawanan'
            ]);

            // Add data
            foreach ($data as $desa) {
                fputcsv($file, [
                    $desa->id,
                    $desa->nama_desa,
                    $desa->kecamatan,
                    $desa->kabupaten,
                    $desa->kasus_narkoba_count,
                    $desa->kerawanan_level
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getKabupatenList()
    {
        $kabupaten = DesaGeojson::getKabupatenList();
        return response()->json($kabupaten);
    }

    public function getKecamatanList(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $query = \App\Models\DesaGeojson::query();
        $query->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
              ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
              ->where('nama_desa', 'not like', '%/%')
              ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
              ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
              ->where('kecamatan', 'not like', '%/%')
              ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
              ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
              ->where('kabupaten', 'not like', '%/%');
        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }
        $kecamatanList = $query->select('kecamatan')->distinct()->pluck('kecamatan');
        return response()->json($kecamatanList);
    }

    public function getDesaList(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $query = \App\Models\DesaGeojson::query();
        $query->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
              ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
              ->where('nama_desa', 'not like', '%/%')
              ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
              ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
              ->where('kecamatan', 'not like', '%/%')
              ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
              ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
              ->where('kabupaten', 'not like', '%/%');
        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }
        if ($kecamatan) {
            $query->where('kecamatan', $kecamatan);
        }
        $desaList = $query->select('nama_desa')->distinct()->pluck('nama_desa');
        return response()->json($desaList);
    }
}
