<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataVerification extends Model
{
    use HasFactory;

    protected $table = 'data_verifications';

    protected $fillable = [
        'table_name',
        'data_id',
        'old_data',
        'new_data',
        'status',
        'admin_id',
        'super_admin_id',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    /**
     * Get the admin who submitted the verification
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the super admin who approved/rejected the verification
     */
    public function superAdmin()
    {
        return $this->belongsTo(User::class, 'super_admin_id');
    }

    /**
     * Get the table display name
     */
    public function getTableDisplayNameAttribute()
    {
        return \App\Services\DuplicateDetectionService::getTableDisplayName($this->table_name);
    }

    /**
     * Get the field labels for this table
     */
    public function getFieldLabelsAttribute()
    {
        return \App\Services\DuplicateDetectionService::getFieldLabels($this->table_name);
    }

    /**
     * Get old data as array safely
     */
    public function getOldDataArrayAttribute()
    {
        if (is_string($this->old_data)) {
            return json_decode($this->old_data, true) ?: [];
        }
        return is_array($this->old_data) ? $this->old_data : [];
    }

    /**
     * Get new data as array safely
     */
    public function getNewDataArrayAttribute()
    {
        if (is_string($this->new_data)) {
            return json_decode($this->new_data, true) ?: [];
        }
        return is_array($this->new_data) ? $this->new_data : [];
    }
}
