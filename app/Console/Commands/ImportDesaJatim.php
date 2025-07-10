<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\DesaGeojson;

class ImportDesaJatim extends Command
{
    protected $signature = 'import:desa-jatim';
    protected $description = 'Import GeoJSON desa Jatim ke database';

    public function handle()
    {
        $path = public_path('geojson/desa-jatim.geojson');

        if (!File::exists($path)) {
            $this->error('❌ File tidak ditemukan di: ' . $path);
            return;
        }

        try {
            $content = File::get($path);
            $data = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error('❌ File GeoJSON tidak valid');
                return;
            }

            if (!isset($data['features'])) {
                $this->error('❌ File GeoJSON tidak mengandung features');
                return;
            }

            $count = 0;
            foreach ($data['features'] as $feature) {
                $properties = $feature['properties'] ?? [];

                // Coba berbagai kemungkinan nama field
                $namaDesa = $properties['nama_desa'] ??
                           $properties['WADMKD'] ??
                           $properties['NAMA_DESA'] ??
                           $properties['desa'] ??
                           'Desa Tidak Diketahui';

                $kecamatan = $properties['kecamatan'] ??
                            $properties['WADMKC'] ??
                            $properties['NAMA_KEC'] ??
                            $properties['kec'] ??
                            'Kecamatan Tidak Diketahui';

                $kabupaten = $properties['kabupaten'] ??
                            $properties['WADMKK'] ??
                            $properties['NAMA_KAB'] ??
                            $properties['kab'] ??
                            'Kabupaten Tidak Diketahui';

                DesaGeojson::updateOrCreate(
                    ['nama_desa' => $namaDesa],
                    [
                        'kecamatan' => $kecamatan,
                        'kabupaten' => $kabupaten,
                        'geometry' => $feature['geometry']
                    ]
                );
                $count++;

                // Progress indicator
                if ($count % 100 == 0) {
                    $this->info("Processed {$count} desa...");
                }
            }

            $this->info("✅ Berhasil import {$count} desa ke database");
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
