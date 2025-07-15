<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekVital extends Model
{
    use HasFactory;

    protected $table = 'objek_vital';

    protected $fillable = [
        'nama_objek',
        'nama_manager',
        'lokasi',
        'no_hp',
    ];
} 