<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Nama tabel (opsional, default Laravel pakai 'pegawais')
    protected $table = 'pegawai';

    // Kolom yang bisa diisi massal (fillable)
    protected $fillable = [
        'nama',
        'jabatan',
    ];
}
