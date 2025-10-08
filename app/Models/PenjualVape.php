<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualVape extends Model
{
    protected $table = 'penjual_vape';
    protected $guarded = [];
    protected $fillable = [
        'nama_toko',
        'pemilik',
        'lokasi',
        'no_hp',
        'liquid_dicurigai',
        'distributor',
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

    protected $casts = [
        'liquid_dicurigai' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
