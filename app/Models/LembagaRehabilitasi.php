<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaRehabilitasi extends Model
{
    use HasFactory;

    protected $table = 'lembaga_rehabilitasi';

    protected $fillable = [
        'nama',
        'jenis_lrehab',
        'nama_ketua',
        'no_hp',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'provinsi_lain',
        'kabupaten_lain',
        'kecamatan_lain',
        'kelurahan_lain',
        'alamat',
        'sertifikasi',
        'nomor_sni_nasional',
        'nomor_sni_reguler',
        'created_by',
    ];

    protected $casts = [
        'sertifikasi' => 'array',
    ];

    public static function getJenisLrehabOptions()
    {
        return ['LRIP', 'LRKM'];
    }

    public static function getSertifikasiOptions()
    {
        return ['IPWL', 'SNI_Nasional', 'SNI_Reguler'];
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
