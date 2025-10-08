<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggaran;

class AnggaranHierarchicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Anggaran::truncate();

        // Main Activity 1: Pelaksanaan Intelijen Berbasis Teknologi
        $mainActivity1 = Anggaran::create([
            'akun' => '3251',
            'kegiatan' => 'Pelaksanaan Intelijen Berbasis Teknologi',
            'anggaran_sebelum' => 250000000,
            'blokir' => 0,
            'is_main_activity' => true,
            'level' => 0,
            'parent_id' => null,
        ]);

        // Sub Activities for Main Activity 1
        Anggaran::create([
            'akun' => '3251.BKA.002.051.A',
            'kegiatan' => 'Pemetaan Informasi Jaringan Intelijen',
            'anggaran_sebelum' => 125000000,
            'blokir' => 0,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity1->id,
        ]);

        Anggaran::create([
            'akun' => '3251.BKA.002.051.B',
            'kegiatan' => 'Pemetaan Informasi Intelijen Taktis',
            'anggaran_sebelum' => 125000000,
            'blokir' => 0,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity1->id,
        ]);

        // Main Activity 2: Pengawasan Tahanan dan Barang Bukti
        $mainActivity2 = Anggaran::create([
            'akun' => '3258',
            'kegiatan' => 'Pengawasan Tahanan dan Barang Bukti',
            'anggaran_sebelum' => 679981000,
            'blokir' => 56850000,
            'is_main_activity' => true,
            'level' => 0,
            'parent_id' => null,
        ]);

        // Sub Activities for Main Activity 2
        Anggaran::create([
            'akun' => '3258.BIA.002.051.A',
            'kegiatan' => 'Pengawasan dan Pengelolaan Barang Bukti',
            'anggaran_sebelum' => 40306000,
            'blokir' => 0,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity2->id,
        ]);

        Anggaran::create([
            'akun' => '3258.BIA.002.051.B',
            'kegiatan' => 'Pengawasan dan Perawatan Tahanan Tindak Pidana Narkotika dan Prekursor',
            'anggaran_sebelum' => 119940000,
            'blokir' => 8100000,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity2->id,
        ]);

        Anggaran::create([
            'akun' => '3258.BIA.002.051.C',
            'kegiatan' => 'Asesmen Terpadu Terhadap Tersangka dan Terdakwa Tindak Pidana Narkotika',
            'anggaran_sebelum' => 519735000,
            'blokir' => 48750000,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity2->id,
        ]);

        // Main Activity 3: Penyidikan Jaringan Peredaran Gelap Narkotika
        $mainActivity3 = Anggaran::create([
            'akun' => '5354',
            'kegiatan' => 'Penyidikan Jaringan Peredaran Gelap Narkotika',
            'anggaran_sebelum' => 1500000000,
            'blokir' => 150000000,
            'is_main_activity' => true,
            'level' => 0,
            'parent_id' => null,
        ]);

        // Sub Activities for Main Activity 3
        Anggaran::create([
            'akun' => '5354.BKA.002.051.A',
            'kegiatan' => 'Penyidikan Kasus Peredaran Narkotika Golongan I',
            'anggaran_sebelum' => 800000000,
            'blokir' => 80000000,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity3->id,
        ]);

        Anggaran::create([
            'akun' => '5354.BKA.002.051.B',
            'kegiatan' => 'Penyidikan Kasus Peredaran Narkotika Golongan II',
            'anggaran_sebelum' => 500000000,
            'blokir' => 50000000,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity3->id,
        ]);

        Anggaran::create([
            'akun' => '5354.BKA.002.051.C',
            'kegiatan' => 'Penyidikan Kasus Peredaran Narkotika Golongan III',
            'anggaran_sebelum' => 200000000,
            'blokir' => 20000000,
            'is_main_activity' => false,
            'level' => 1,
            'parent_id' => $mainActivity3->id,
        ]);
    }
}
