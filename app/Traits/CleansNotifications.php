<?php

namespace App\Traits;

use App\Models\DataVerification;

trait CleansNotifications
{
    /**
     * Hapus notifikasi approved untuk data yang ditindaklanjuti
     */
    protected function cleanApprovedNotifications($tableName, $dataId, $adminId = null)
    {
        $adminId = $adminId ?? request()->user()->id;

        DataVerification::where('admin_id', $adminId)
            ->where('data_id', $dataId)
            ->where('table_name', $tableName)
            ->where('status', 'approved')
            ->delete();
    }
}
