<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $table = 'jalur_masuk';

    protected $fillable = [
        'jenis_transportasi',
        'nama_tempat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the jenis titik masuk options
     */
    public static function getJenisTitikMasukOptions()
    {
        return [
            'Darat' => 'Darat',
            'Laut' => 'Laut',
            'Udara' => 'Udara'
        ];
    }
}