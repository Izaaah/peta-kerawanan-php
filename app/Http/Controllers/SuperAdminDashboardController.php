<?php

namespace App\Http\Controllers;

use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;
use App\Models\TkpResidivisIndividu;
use App\Models\Anggaran;
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

        // Data untuk pie chart status individu (Napi/Non napi)
        $statusPie = [
            'Napi' => \App\Models\DataIndividuTsk::where('status', 'Napi')->count(),
            'Non napi' => \App\Models\DataIndividuTsk::where('status', 'Non napi')->count(),
        ];

        // Data untuk pie chart residivis (Residivis/Non Residivis)
        $residivisPie = [
            'Residivis' => \App\Models\DataIndividuTsk::where('residivis', true)->count(),
            'Non Residivis' => \App\Models\DataIndividuTsk::where('residivis', false)->count(),
        ];

        // Data terbaru
        $kasusTerbaru = KasusNarkoba::with('desa')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil data anggaran berdasarkan role user
        $user = auth()->user();
        $anggaranQuery = Anggaran::query();
        if ($user && !$user->isSuperAdmin()) {
            $anggaranQuery->where('created_by', $user->id);
        }

        $anggaranList = (clone $anggaranQuery)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalAnggaranSebelum = (clone $anggaranQuery)->sum('anggaran_sebelum');
        $totalBlokir = (clone $anggaranQuery)->sum('blokir');
        $totalSetelah = $totalAnggaranSebelum - $totalBlokir;

        return view('super-admin.dashboard', compact(
            'totalKasus',
            'totalDesa',
            'kabupatenCount',
            'kecamatanCount',
            'kasusPerKabupaten',
            'kasusPerKecamatan',
            'trendBulanan',
            'kasusTerbaru',
            'statusPie',
            'residivisPie',
            'anggaranList',
            'totalAnggaranSebelum',
            'totalBlokir',
            'totalSetelah'
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
