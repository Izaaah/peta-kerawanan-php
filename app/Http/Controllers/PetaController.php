<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PetaController extends Controller
{
    public function geojson()
    {
        $path = public_path('geojson/desa-jatim.geojson');

        if (!File::exists($path)) {
            return response()->json([
                'error' => 'File GeoJSON tidak ditemukan',
                'message' => 'Pastikan file desa_jatim_sederhana.geojson ada di folder public/geojson/'
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
}
