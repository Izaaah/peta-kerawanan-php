<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TkpResidivisIndividu;
use App\Models\DataIndividuTsk;
use Illuminate\Support\Facades\DB;

class TkpResidivisIndividuSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing individu records that are residivis
        $residivisIndividu = DataIndividuTsk::where('residivis', true)->get();

        // If no residivis found, create some sample data first
        if ($residivisIndividu->isEmpty()) {
            // Create some sample residivis individuals
            $sampleIndividu = [
                [
                    'nama' => 'Ahmad Susanto',
                    'nik' => '3573010101990001',
                    'nkk' => '3573010101990001',
                    'provinsi' => 'Jawa Timur',
                    'kabupaten' => 'Surabaya',
                    'kecamatan' => 'Tegalsari',
                    'kelurahan' => 'Kedungdoro',
                    'alamat' => 'Jl. Tegalsari No. 123',
                    'nama_ayah' => 'Budi Susanto',
                    'nik_ayah' => '3573010101700001',
                    'nama_ibu' => 'Siti Aminah',
                    'nik_ibu' => '3573010101750001',
                    'peran_jaringan' => 'bandar',
                    'modus_operasi' => 'Penjualan melalui kurir',
                    'jenis_narkotika' => 'Sabu-sabu',
                    'skala_kelas' => 'dibawah1kg',
                    'status' => 'Napi',
                    'residivis' => true,
                    'sumber_informasi' => 'informan'
                ],
                [
                    'nama' => 'Rudi Hermawan',
                    'nik' => '3573010101990002',
                    'nkk' => '3573010101990002',
                    'provinsi' => 'Jawa Timur',
                    'kabupaten' => 'Surabaya',
                    'kecamatan' => 'Genteng',
                    'kelurahan' => 'Genteng',
                    'alamat' => 'Jl. Genteng No. 456',
                    'nama_ayah' => 'Slamet Hermawan',
                    'nik_ayah' => '3573010101700002',
                    'nama_ibu' => 'Rina Marlina',
                    'nik_ibu' => '3573010101750002',
                    'peran_jaringan' => 'kurir',
                    'modus_operasi' => 'Pengiriman paket',
                    'jenis_narkotika' => 'Ganja',
                    'skala_kelas' => 'dibawah1ons',
                    'status' => 'Napi',
                    'residivis' => true,
                    'sumber_informasi' => 'analisa sosmed'
                ],
                [
                    'nama' => 'Dedi Kurniawan',
                    'nik' => '3573010101990003',
                    'nkk' => '3573010101990003',
                    'provinsi' => 'Jawa Timur',
                    'kabupaten' => 'Malang',
                    'kecamatan' => 'Klojen',
                    'kelurahan' => 'Klojen',
                    'alamat' => 'Jl. Klojen No. 789',
                    'nama_ayah' => 'Karno Kurniawan',
                    'nik_ayah' => '3573010101700003',
                    'nama_ibu' => 'Yuni Safitri',
                    'nik_ibu' => '3573010101750003',
                    'peran_jaringan' => 'gudang',
                    'modus_operasi' => 'Penyimpanan di gudang tersembunyi',
                    'jenis_narkotika' => 'Ekstasi',
                    'skala_kelas' => 'dibawah1kg',
                    'status' => 'Napi',
                    'residivis' => true,
                    'sumber_informasi' => 'analisa aliran dana'
                ],
                [
                    'nama' => 'Eko Prasetyo',
                    'nik' => '3573010101990004',
                    'nkk' => '3573010101990004',
                    'provinsi' => 'Jawa Timur',
                    'kabupaten' => 'Sidoarjo',
                    'kecamatan' => 'Sidoarjo',
                    'kelurahan' => 'Sidoarjo',
                    'alamat' => 'Jl. Sidoarjo No. 101',
                    'nama_ayah' => 'Sutrisno Prasetyo',
                    'nik_ayah' => '3573010101700004',
                    'nama_ibu' => 'Sri Wahyuni',
                    'nik_ibu' => '3573010101750004',
                    'peran_jaringan' => 'broker',
                    'modus_operasi' => 'Perantara transaksi',
                    'jenis_narkotika' => 'Kokain',
                    'skala_kelas' => 'diatas1kg',
                    'status' => 'Napi',
                    'residivis' => true,
                    'sumber_informasi' => 'informan'
                ],
                [
                    'nama' => 'Bambang Setiawan',
                    'nik' => '3573010101990005',
                    'nkk' => '3573010101990005',
                    'provinsi' => 'Jawa Timur',
                    'kabupaten' => 'Gresik',
                    'kecamatan' => 'Gresik',
                    'kelurahan' => 'Gresik',
                    'alamat' => 'Jl. Gresik No. 202',
                    'nama_ayah' => 'Sukarno Setiawan',
                    'nik_ayah' => '3573010101700005',
                    'nama_ibu' => 'Siti Nurhaliza',
                    'nik_ibu' => '3573010101750005',
                    'peran_jaringan' => 'beking',
                    'modus_operasi' => 'Perlindungan jaringan',
                    'jenis_narkotika' => 'Heroin',
                    'skala_kelas' => 'dibawah1kg',
                    'status' => 'Napi',
                    'residivis' => true,
                    'sumber_informasi' => 'analisa sosmed'
                ]
            ];

            foreach ($sampleIndividu as $individu) {
                DataIndividuTsk::create($individu);
            }

            // Get the newly created residivis
            $residivisIndividu = DataIndividuTsk::where('residivis', true)->get();
        }

        // Sample TKP data for residivis
        $tkpData = [];

        // Get all residivis individuals as array
        $residivisArray = $residivisIndividu->toArray();

        // Create TKP data for each individual
        foreach ($residivisArray as $index => $individu) {
            // Create 2 TKP records per individual
            $tkpData[] = [
                'individu_id' => $individu['id'],
                'provinsi' => $individu['provinsi'],
                'kabupaten' => $individu['kabupaten'],
                'kecamatan' => $individu['kecamatan'],
                'desa' => $individu['kelurahan'],
                'lokasi' => $individu['alamat']
            ];

            // Create second TKP with different location
            $tkpData[] = [
                'individu_id' => $individu['id'],
                'provinsi' => $individu['provinsi'],
                'kabupaten' => $individu['kabupaten'],
                'kecamatan' => $this->getDifferentKecamatan($individu['kecamatan']),
                'desa' => $this->getDifferentDesa($individu['kelurahan']),
                'lokasi' => $this->getDifferentLokasi($individu['kabupaten'])
            ];
        }

        // Insert TKP data
        foreach ($tkpData as $tkp) {
            TkpResidivisIndividu::create($tkp);
        }

        $this->command->info('TKP Residivis Individu seeder completed successfully!');
    }

    /**
     * Get different kecamatan for variety
     */
    private function getDifferentKecamatan($currentKecamatan)
    {
        $kecamatanOptions = [
            'Tegalsari' => 'Genteng',
            'Genteng' => 'Wonokromo',
            'Wonokromo' => 'Tegalsari',
            'Klojen' => 'Blimbing',
            'Blimbing' => 'Klojen',
            'Sidoarjo' => 'Tulangan',
            'Tulangan' => 'Sidoarjo',
            'Gresik' => 'Manyar',
            'Manyar' => 'Gresik'
        ];

        return $kecamatanOptions[$currentKecamatan] ?? 'Genteng';
    }

    /**
     * Get different desa for variety
     */
    private function getDifferentDesa($currentDesa)
    {
        $desaOptions = [
            'Kedungdoro' => 'Genteng',
            'Genteng' => 'Wonokromo',
            'Wonokromo' => 'Kedungdoro',
            'Klojen' => 'Blimbing',
            'Blimbing' => 'Klojen',
            'Sidoarjo' => 'Tulangan',
            'Tulangan' => 'Sidoarjo',
            'Gresik' => 'Manyar',
            'Manyar' => 'Gresik'
        ];

        return $desaOptions[$currentDesa] ?? 'Genteng';
    }

    /**
     * Get different lokasi for variety
     */
    private function getDifferentLokasi($kabupaten)
    {
        $lokasiOptions = [
            'Surabaya' => 'Mall Tunjungan Plaza, Surabaya',
            'Malang' => 'Mall Malang Town Square, Malang',
            'Sidoarjo' => 'Pasar Tulangan, Sidoarjo',
            'Gresik' => 'Pelabuhan Gresik, Gresik'
        ];

        return $lokasiOptions[$kabupaten] ?? 'Terminal Bus, ' . $kabupaten;
    }
}
