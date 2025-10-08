<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggiatNarkotika extends Model
{
    use HasFactory;
    protected $table = 'penggiat_narkotika';
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'kegiatan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'provinsi_lain',
        'kabupaten_lain',
        'kecamatan_lain',
        'kelurahan_lain',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
