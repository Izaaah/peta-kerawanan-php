<?php

namespace App\Http\Controllers\admin;

use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;
use App\Models\TkpResidivisIndividu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $userKabupaten = $user->name; // diasumsikan nama user = kabupaten/kota
        $userId = $user->id;

        // Data untuk statistik dashboard (hanya data yang diinput user ini)
        $totalKasus = TkpResidivisIndividu::where('created_by', $userId)->count();

        // Filter desa data hanya untuk kabupaten user
        $filteredDesaQuery = DesaGeojson::query()
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
            ->where('nama_desa', 'not like', '%/%')
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
            ->where('kecamatan', 'not like', '%/%')
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', $userKabupaten);

        $totalDesa = $filteredDesaQuery->count();
        $kabupatenCount = 1; // hanya kabupaten user
        $kecamatanCount = $filteredDesaQuery->distinct('kecamatan')->count('kecamatan');

        // Data untuk grafik kasus per kabupaten (hanya kabupaten user, hanya data user ini)
        $kasusPerKabupaten = TkpResidivisIndividu::select('kabupaten', DB::raw('count(*) as total'))
            ->where('created_by', $userId)
            ->where('kabupaten', $userKabupaten)
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->get();

        // Data untuk grafik kasus per kecamatan (hanya kabupaten user, hanya data user ini)
        $kasusPerKecamatan = TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->where('created_by', $userId)
            ->where('kabupaten', $userKabupaten)
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        // Data untuk pie chart status individu (hanya data user ini)
        $statusPie = [
            'Napi' => \App\Models\DataIndividuTsk::where('status', 'Napi')->where('created_by', $userId)->count(),
            'Non napi' => \App\Models\DataIndividuTsk::where('status', 'Non napi')->where('created_by', $userId)->count(),
        ];

        // Data untuk pie chart residivis (hanya data user ini)
        $residivisPie = [
            'Residivis' => \App\Models\DataIndividuTsk::where('residivis', true)->where('created_by', $userId)->count(),
            'Non Residivis' => \App\Models\DataIndividuTsk::where('residivis', false)->where('created_by', $userId)->count(),
        ];

        // Data terbaru (hanya data user ini)
        // $kasusTerbaru = KasusNarkoba::with('desa')
        //     ->where('created_by', $userId)
        //     ->orderBy('created_at', 'desc')
        //     ->limit(5)
        //     ->get();

        return view('admin.dashboard', compact(
            'totalKasus',
            'totalDesa',
            'kabupatenCount',
            'kecamatanCount',
            'kasusPerKabupaten',
            'kasusPerKecamatan',
            // 'kasusTerbaru',
            'statusPie',
            'residivisPie'
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
