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
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
