<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LsmNarkotika;
use App\Models\DataVerification;

class LsmNarkotikaSeeder extends Seeder
{
    public function run()
    {
        // Data LSM yang akan di-insert
        $lsm = LsmNarkotika::create([
            'nama_lsm'      => 'LSM A',
            'ketua_lsm'     => 'Budi',
            'alamat'        => 'Jl. Mawar',
            'no_hp_ketua'   => '08123456789'
        ]);

        // Data verifikasi dengan data lama dan baru sama (bisa di-ACC)
        $data = [
            'nama_lsm'      => 'LSM A',
            'ketua_lsm'     => 'Budi',
            'alamat'        => 'Jl. Mawar',
            'no_hp_ketua'   => '08123456789'
        ];

        DataVerification::create([
            'table_name'    => 'lsm_narkotika',
            'data_id'       => $lsm->id,
            'old_data'      => json_encode($data),
            'new_data'      => json_encode($data),
            'status'        => 'pending',
            'admin_id'      => 1, // ganti sesuai id admin yang ada
            'super_admin_id'=> auth()->id()
        ]);

        // Data LSM kedua
        $lsm2 = LsmNarkotika::create([
            'nama_lsm'      => 'LSM B',
            'ketua_lsm'     => 'Siti',
            'alamat'        => 'Jl. Kenanga',
            'no_hp_ketua'   => '08129876543'
        ]);

        $data2 = [
            'nama_lsm'      => 'LSM B',
            'ketua_lsm'     => 'Siti',
            'alamat'        => 'Jl. Kenanga',
            'no_hp_ketua'   => '08129876543'
        ];

        DataVerification::create([
            'table_name'    => 'lsm_narkotika',
            'data_id'       => $lsm2->id,
            'old_data'      => json_encode($data2),
            'new_data'      => json_encode($data2),
            'status'        => 'pending',
            'admin_id'      => 1, // ganti sesuai id admin yang ada
            'super_admin_id'=> null
        ]);
    }
} 