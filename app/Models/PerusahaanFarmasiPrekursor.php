<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerusahaanFarmasiPrekursor extends Model
{
    protected $table = 'perusahaan_farmasi_preksursor';
    protected $guarded = [];
    protected $fillable = [
        'jenis',
        'nama',
        'manager',
        'lokasi',
        'no_hp',
        'prekusor',
        'ijin_penerbit',
        'jumlah',
        'tujuan',
        'created_by',
    ];
}
