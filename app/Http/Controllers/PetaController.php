<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaController extends Controller
{
    public function getPetaKerawanan()
    {
        $jumlahKasus = DB::table('kasus_narkoba')
            ->select('nama_desa', DB::raw('count(*) as jumlah'))
            ->groupBy('nama_desa')
            ->pluck('jumlah', 'nama_desa'); // hasil: ['Desa A' => 10, ...]

        $desa = DB::table('desa_geojson')->get();

        $features = $desa->map(function ($item) use ($jumlahKasus) {
            $jumlah = $jumlahKasus[strtolower($item->nama_desa)] ?? 0;

            return [
                'type' => 'Feature',
                'properties' => [
                    'nama_desa' => $item->nama_desa,
                    'jumlah_kasus' => $jumlah
                ],
                'geometry' => json_decode($item->geometry)
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }
}
