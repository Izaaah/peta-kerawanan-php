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
        'posisi',
        'lokasi',
        'no_hp'
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
}
