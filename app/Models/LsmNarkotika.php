<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LsmNarkotika extends Model
{
    use HasFactory;

    protected $table = 'lsm_narkotika';

    protected $fillable = [
        'nama_lsm',
        'ketua_lsm',
        'alamat',
        'no_hp_ketua',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
