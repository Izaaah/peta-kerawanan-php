<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataVerificationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('data_verifications')->insert([
            [
                'table_name' => 'lsm_narkotika',
                'data_id' => 1,
                'old_data' => json_encode(['nama_lsm' => 'LSM A', 'ketua_lsm' => 'Budi', 'alamat' => 'Jl. Mawar', 'no_hp_ketua' => '08123456789']),
                'new_data' => json_encode(['nama_lsm' => 'LSM A Baru', 'ketua_lsm' => 'Budi', 'alamat' => 'Jl. Melati', 'no_hp_ketua' => '08123456789']),
                'status' => 'pending',
                'admin_id' => 2,
                'super_admin_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_name' => 'lsm_narkotika',
                'data_id' => 2,
                'old_data' => json_encode(['nama_lsm' => 'LSM B', 'ketua_lsm' => 'Andi', 'alamat' => 'Jl. Kenanga', 'no_hp_ketua' => '08129876543']),
                'new_data' => json_encode(['nama_lsm' => 'LSM B', 'ketua_lsm' => 'Andi', 'alamat' => 'Jl. Kenanga No. 2', 'no_hp_ketua' => '08129876543']),
                'status' => 'approved',
                'admin_id' => 3,
                'super_admin_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_name' => 'lsm_narkotika',
                'data_id' => 3,
                'old_data' => json_encode(['nama_lsm' => 'LSM C', 'ketua_lsm' => 'Sari', 'alamat' => 'Jl. Anggrek', 'no_hp_ketua' => '08121234567']),
                'new_data' => json_encode(['nama_lsm' => 'LSM C', 'ketua_lsm' => 'Sari', 'alamat' => 'Jl. Anggrek', 'no_hp_ketua' => '08121234567']),
                'status' => 'rejected',
                'admin_id' => 4,
                'super_admin_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 