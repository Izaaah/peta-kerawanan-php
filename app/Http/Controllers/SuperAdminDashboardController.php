<?php

namespace App\Http\Controllers;

use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;
use App\Models\TkpResidivisIndividu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik dashboard
        $totalKasus = TkpResidivisIndividu::count();

        // Filter desa data to exclude entries with "/", "area", and "unknown"
        $filteredDesaQuery = DesaGeojson::query()
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
            ->where('nama_desa', 'not like', '%/%')
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
            ->where('kecamatan', 'not like', '%/%')
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
            ->where('kabupaten', 'not like', '%/%');

        $totalDesa = $filteredDesaQuery->count();
        $kabupatenCount = $filteredDesaQuery->distinct('kabupaten')->count('kabupaten');
        $kecamatanCount = $filteredDesaQuery->distinct('kecamatan')->count('kecamatan');

        // Data untuk grafik kasus per kabupaten
        $kasusPerKabupaten = TkpResidivisIndividu::select('kabupaten', DB::raw('count(*) as total'))
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Data untuk grafik kasus per kecamatan
        $kasusPerKecamatan = TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Data untuk grafik trend bulanan
        $trendBulanan = KasusNarkoba::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('count(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data untuk pie chart status kasus (contoh)
        $statusKasus = [
            'Aktif' => KasusNarkoba::where('keterangan', 'like', '%aktif%')->count(),
            'Selesai' => KasusNarkoba::where('keterangan', 'like', '%selesai%')->count(),
            'Dalam Proses' => KasusNarkoba::where('keterangan', 'like', '%proses%')->count(),
        ];

        // Data terbaru
        $kasusTerbaru = KasusNarkoba::with('desa')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('super-admin.dashboard', compact(
            'totalKasus',
            'totalDesa',
            'kabupatenCount',
            'kecamatanCount',
            'kasusPerKabupaten',
            'kasusPerKecamatan',
            'trendBulanan',
            'statusKasus',
            'kasusTerbaru'
        ));
    }

    public function getIndividuCount(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $desa = $request->desa;

        $count = \App\Models\DataIndividuTsk::whereRaw('LOWER(TRIM(kabupaten)) = ?', [strtolower(trim($kabupaten))])
            ->whereRaw('LOWER(TRIM(kecamatan)) = ?', [strtolower(trim($kecamatan))])
            ->whereRaw('LOWER(TRIM(kelurahan)) = ?', [strtolower(trim($desa))])
            ->count();

        return response()->json(['count' => $count]);
    }
}
