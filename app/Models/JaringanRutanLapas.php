<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaringanRutanLapas extends Model
{
    use HasFactory;

    protected $table = 'jaringan_rutan_lapas';

    protected $fillable = [
        'nama_napi',
        'jenis_napi',
        'lapas',
        'lokasi_lapas',
        'peran_dalam_jaringan',
        'status_proses',
        'keterangan',
        'created_by',
    ];

    public static function getJenisNapiOptions()
    {
        return ['Napi Narkotika', 'Napi Non Narkotika'];
    }
    public static function getStatusProsesOptions()
    {
        return ['Ditahan', 'Bebas', 'Dalam proses', 'Tidak diketahui'];
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
