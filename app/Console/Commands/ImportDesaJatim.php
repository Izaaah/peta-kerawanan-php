<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ImportDesaJatim extends Command
{
    protected $signature = 'import:desa-jatim';
    protected $description = 'Import GeoJSON desa Jatim ke database';

    public function handle()
    {
        $path = 'public/geojson/desa_jatim_sederhana.geojson';

        if (!Storage::exists($path)) {
            $this->error('❌ File tidak ditemukan di: ' . $path);
            return;
        }

        $json = Storage::get($path);
        $data = json_decode($json, true);

        if (!$data || !isset($data['features'])) {
            $this->error('❌ File JSON tidak valid atau tidak mengandung fitur.');
            return;
        }

        foreach ($data['features'] as $feature) {
            DB::table('desa_geojson')->insert([
                'nama_desa' => $feature['properties']['WADMKD'] ?? 'Tidak diketahui',
                'kecamatan' => $feature['properties']['WADMKC'] ?? '-',
                'kabupaten' => $feature['properties']['WADMKK'] ?? '-',
                'geometry' => json_encode($feature['geometry']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->info('✅ Import GeoJSON berhasil!');
    }
}
