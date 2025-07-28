<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\DataVerification;

class DuplicateDetectionService
{
    /**
     * Check if data is duplicate and create verification record if needed
     */
    public static function checkAndCreateVerification($tableName, $newData, $adminId, $existingId = null)
    {
        $duplicateFields = self::getDuplicateFields($tableName);
        
        if (empty($duplicateFields)) {
            return false; // No duplicate check needed
        }

        // Build query to check for duplicates
        $query = DB::table($tableName);
        
        foreach ($duplicateFields as $field) {
            if (isset($newData[$field]) && !empty($newData[$field])) {
                $query->where($field, $newData[$field]);
            }
        }

        // Exclude current record if updating
        if ($existingId) {
            $query->where('id', '!=', $existingId);
        }

        $existingRecord = $query->first();

        if ($existingRecord) {
            // Create verification record
            DataVerification::create([
                'table_name' => $tableName,
                'data_id' => $existingId ?? 0, // 0 for new records
                'old_data' => json_encode((array) $existingRecord),
                'new_data' => json_encode($newData),
                'status' => 'pending',
                'admin_id' => $adminId,
            ]);

            return true; // Duplicate found
        }

        return false; // No duplicate
    }

    /**
     * Get duplicate fields for each table
     */
    private static function getDuplicateFields($tableName)
    {
        $duplicateFields = [
            'data_individu_tsk' => ['nik', 'nkk'],
            'lsm_narkotika' => ['nama_lsm', 'ketua_lsm'],
            'medsos' => ['nama_akun', 'link_akun'],
            'penjual_vape' => ['nama_toko', 'pemilik'],
            'perusahaan_farmasi_prekursor' => ['nama', 'manager'],
            'objek_vital' => ['nama_objek', 'nama_manager'],
            'penggiat_narkotika' => ['nama', 'no_hp'],
            'penginapan' => ['nama', 'nama_pengelola'],
            'rutan_lapas' => ['nama', 'manager'],
            'thm' => ['nama_thm', 'ketua_thm'],
            'transportasi' => ['jenis_transportasi', 'nama_pihak'],
            'ekspedisi' => ['nama', 'manager'],
            'lembaga_rehabilitasi' => ['nama'],
        ];

        return $duplicateFields[$tableName] ?? [];
    }

    /**
     * Get human readable field names
     */
    public static function getFieldLabels($tableName)
    {
        $fieldLabels = [
            'data_individu_tsk' => [
                'nik' => 'NIK',
                'nkk' => 'NKK'
            ],
            'lsm_narkotika' => [
                'nama_lsm' => 'Nama LSM',
                'ketua_lsm' => 'Ketua LSM'
            ],
            'medsos' => [
                'nama_akun' => 'Nama Akun',
                'link_akun' => 'Link Akun'
            ],
            'penjual_vape' => [
                'nama_toko' => 'Nama Toko',
                'pemilik' => 'Pemilik'
            ],
            'perusahaan_farmasi_prekursor' => [
                'nama' => 'Nama Perusahaan',
                'manager' => 'Manager'
            ],
            'objek_vital' => [
                'nama_objek' => 'Nama Objek',
                'nama_manager' => 'Nama Manager'
            ],
            'penggiat_narkotika' => [
                'nama' => 'Nama',
                'no_hp' => 'No. HP'
            ],
            'penginapan' => [
                'nama' => 'Nama',
                'nama_pengelola' => 'Nama Pengelola'
            ],
            'rutan_lapas' => [
                'nama' => 'Nama',
                'manager' => 'Manager'
            ],
            'thm' => [
                'nama_thm' => 'Nama THM',
                'ketua_thm' => 'Ketua THM'
            ],
            'transportasi' => [
                'jenis_transportasi' => 'Jenis Transportasi',
                'nama_pihak' => 'Nama Pihak'
            ],
            'ekspedisi' => [
                'nama' => 'Nama',
                'manager' => 'Manager'
            ],
            'lembaga_rehabilitasi' => [
                'nama' => 'Nama'
            ],
        ];

        return $fieldLabels[$tableName] ?? [];
    }

    /**
     * Get table display name
     */
    public static function getTableDisplayName($tableName)
    {
        $tableNames = [
            'data_individu_tsk' => 'Data Individu TSK',
            'lsm_narkotika' => 'LSM Narkotika',
            'medsos' => 'Media Sosial',
            'penjual_vape' => 'Penjual Vape',
            'perusahaan_farmasi_prekursor' => 'Perusahaan Farmasi Prekursor',
            'objek_vital' => 'Objek Vital',
            'penggiat_narkotika' => 'Penggiat Narkotika',
            'penginapan' => 'Penginapan',
            'rutan_lapas' => 'Rutan/Lapas',
            'thm' => 'THM',
            'transportasi' => 'Transportasi',
            'ekspedisi' => 'Ekspedisi',
            'lembaga_rehabilitasi' => 'Lembaga Rehabilitasi',
        ];

        return $tableNames[$tableName] ?? $tableName;
    }
} 