<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\DesaGeojson;
use Illuminate\Support\Facades\DB;

class ImportDesaJatim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:desa-jatim {--force : Force import even if data exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data desa dari file GeoJSON ke database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai import data desa Jawa Timur...');

        $path = public_path('geojson/desa-jatim.geojson');

        if (!File::exists($path)) {
            $this->error('File GeoJSON tidak ditemukan di: ' . $path);
            return 1;
        }

        $content = File::get($path);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('File GeoJSON tidak valid');
            return 1;
        }

        // Check if data already exists
        if (DesaGeojson::count() > 0 && !$this->option('force')) {
            $this->warn('Data desa sudah ada di database. Gunakan --force untuk import ulang.');
            return 0;
        }

        // Clear existing data if force option is used
        if ($this->option('force')) {
            $this->info('Menghapus data lama...');
            DesaGeojson::truncate();
        }

        $features = $data['features'] ?? [];
        $totalFeatures = count($features);
        $this->info("Ditemukan {$totalFeatures} desa untuk diimport...");

        $bar = $this->output->createProgressBar($totalFeatures);
        $bar->start();

        $imported = 0;
        $errors = 0;

        foreach ($features as $feature) {
            try {
                $properties = $feature['properties'] ?? [];
                $geometry = $feature['geometry'] ?? [];

                // Extract nama desa, kecamatan, kabupaten dari properties
                $namaDesa = $properties['NAMA_DESA'] ?? $properties['nama_desa'] ?? 'Unknown';
                $kecamatan = $properties['NAMA_KEC'] ?? $properties['nama_kec'] ?? 'Unknown';
                $kabupaten = $properties['NAMA_KAB'] ?? $properties['nama_kab'] ?? 'Unknown';

                // Check if desa already exists
                $existingDesa = DesaGeojson::where('nama_desa', $namaDesa)
                    ->where('kecamatan', $kecamatan)
                    ->where('kabupaten', $kabupaten)
                    ->first();

                if (!$existingDesa) {
                    DesaGeojson::create([
                        'nama_desa' => $namaDesa,
                        'kecamatan' => $kecamatan,
                        'kabupaten' => $kabupaten,
                        'geometry' => $geometry
                    ]);
                    $imported++;
                }

            } catch (\Exception $e) {
                $errors++;
                $this->error("\nError importing desa: " . ($namaDesa ?? 'Unknown') . " - " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("Import selesai!");
        $this->info("Berhasil diimport: {$imported} desa");
        if ($errors > 0) {
            $this->warn("Error: {$errors} desa");
        }

        // Show summary
        $totalInDb = DesaGeojson::count();
        $this->info("Total desa di database: {$totalInDb}");

        return 0;
    }
}
