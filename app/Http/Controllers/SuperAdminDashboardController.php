<?php

namespace App\Http\Controllers;

use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik dashboard
        $totalKasus = KasusNarkoba::count();
        $totalDesa = DesaGeojson::count();
        $kabupatenCount = DesaGeojson::distinct('kabupaten')->count('kabupaten');
        $kecamatanCount = DesaGeojson::distinct('kecamatan')->count('kecamatan');

        // Data untuk grafik kasus per kabupaten
        $kasusPerKabupaten = KasusNarkoba::select('kabupaten', DB::raw('count(*) as total'))
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Data untuk grafik kasus per kecamatan
        $kasusPerKecamatan = KasusNarkoba::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->limit(10)
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
}
