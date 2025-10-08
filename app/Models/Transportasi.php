<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;

    protected $table = 'transportasi';

    protected $fillable = [
        'jenis_transportasi',
        'nama_pihak',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'provinsi_lain',
        'kabupaten_lain',
        'kecamatan_lain',
        'kelurahan_lain',
        'nama_manager',
        'jabatan',
        'no_hp',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the jenis transportasi options
     */
    public static function getJenisTransportasiOptions()
    {
        return [
            'Darat' => 'Darat',
            'Laut' => 'Laut',
            'Udara' => 'Udara'
        ];
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
