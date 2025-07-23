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
}
