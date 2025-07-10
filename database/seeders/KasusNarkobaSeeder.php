<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;

class KasusNarkobaSeeder extends Seeder
{
    public function run(): void
    {
        // Data desa contoh
        $desaData = [
            ['nama_desa' => 'Desa A', 'kecamatan' => 'Kecamatan A', 'kabupaten' => 'Surabaya'],
            ['nama_desa' => 'Desa B', 'kecamatan' => 'Kecamatan B', 'kabupaten' => 'Surabaya'],
            ['nama_desa' => 'Desa C', 'kecamatan' => 'Kecamatan C', 'kabupaten' => 'Malang'],
            ['nama_desa' => 'Desa D', 'kecamatan' => 'Kecamatan D', 'kabupaten' => 'Malang'],
            ['nama_desa' => 'Desa E', 'kecamatan' => 'Kecamatan E', 'kabupaten' => 'Sidoarjo'],
            ['nama_desa' => 'Desa F', 'kecamatan' => 'Kecamatan F', 'kabupaten' => 'Sidoarjo'],
            ['nama_desa' => 'Desa G', 'kecamatan' => 'Kecamatan G', 'kabupaten' => 'Gresik'],
            ['nama_desa' => 'Desa H', 'kecamatan' => 'Kecamatan H', 'kabupaten' => 'Gresik'],
            ['nama_desa' => 'Desa I', 'kecamatan' => 'Kecamatan I', 'kabupaten' => 'Mojokerto'],
            ['nama_desa' => 'Desa J', 'kecamatan' => 'Kecamatan J', 'kabupaten' => 'Mojokerto'],
        ];

        // Insert data desa
        foreach ($desaData as $desa) {
            DesaGeojson::create([
                'nama_desa' => $desa['nama_desa'],
                'kecamatan' => $desa['kecamatan'],
                'kabupaten' => $desa['kabupaten'],
                'geometry' => json_encode(['type' => 'Polygon', 'coordinates' => [[[0,0], [1,0], [1,1], [0,1], [0,0]]]])
            ]);
        }

        // Data kasus contoh
        $kasusData = [
            ['nama_desa' => 'Desa A', 'kecamatan' => 'Kecamatan A', 'kabupaten' => 'Surabaya', 'keterangan' => 'Kasus aktif - pengawasan intensif'],
            ['nama_desa' => 'Desa A', 'kecamatan' => 'Kecamatan A', 'kabupaten' => 'Surabaya', 'keterangan' => 'Kasus selesai - rehabilitasi'],
            ['nama_desa' => 'Desa B', 'kecamatan' => 'Kecamatan B', 'kabupaten' => 'Surabaya', 'keterangan' => 'Kasus dalam proses - investigasi'],
            ['nama_desa' => 'Desa B', 'kecamatan' => 'Kecamatan B', 'kabupaten' => 'Surabaya', 'keterangan' => 'Kasus aktif - pengawasan'],
            ['nama_desa' => 'Desa C', 'kecamatan' => 'Kecamatan C', 'kabupaten' => 'Malang', 'keterangan' => 'Kasus selesai - penanganan'],
            ['nama_desa' => 'Desa C', 'kecamatan' => 'Kecamatan C', 'kabupaten' => 'Malang', 'keterangan' => 'Kasus dalam proses'],
            ['nama_desa' => 'Desa D', 'kecamatan' => 'Kecamatan D', 'kabupaten' => 'Malang', 'keterangan' => 'Kasus aktif'],
            ['nama_desa' => 'Desa E', 'kecamatan' => 'Kecamatan E', 'kabupaten' => 'Sidoarjo', 'keterangan' => 'Kasus selesai'],
            ['nama_desa' => 'Desa E', 'kecamatan' => 'Kecamatan E', 'kabupaten' => 'Sidoarjo', 'keterangan' => 'Kasus dalam proses'],
            ['nama_desa' => 'Desa F', 'kecamatan' => 'Kecamatan F', 'kabupaten' => 'Sidoarjo', 'keterangan' => 'Kasus aktif'],
            ['nama_desa' => 'Desa G', 'kecamatan' => 'Kecamatan G', 'kabupaten' => 'Gresik', 'keterangan' => 'Kasus selesai'],
            ['nama_desa' => 'Desa H', 'kecamatan' => 'Kecamatan H', 'kabupaten' => 'Gresik', 'keterangan' => 'Kasus dalam proses'],
            ['nama_desa' => 'Desa I', 'kecamatan' => 'Kecamatan I', 'kabupaten' => 'Mojokerto', 'keterangan' => 'Kasus aktif'],
            ['nama_desa' => 'Desa J', 'kecamatan' => 'Kecamatan J', 'kabupaten' => 'Mojokerto', 'keterangan' => 'Kasus selesai'],
        ];

        // Insert data kasus dengan tanggal yang berbeda untuk trend
        foreach ($kasusData as $index => $kasus) {
            $createdAt = now()->subDays(rand(1, 365)); // Random date dalam 1 tahun terakhir
            KasusNarkoba::create([
                'nama_desa' => $kasus['nama_desa'],
                'kecamatan' => $kasus['kecamatan'],
                'kabupaten' => $kasus['kabupaten'],
                'keterangan' => $kasus['keterangan'],
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ]);
        }
    }
}
