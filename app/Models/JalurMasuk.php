<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $table = 'jalur_masuk';

    protected $fillable = [
        'jenis_transportasi',            // string: nama bidang/seksi
        'nama_tempat',   // integer
        'provinsi',        // integer
        'kabupaten',        // integer
        'created_by',        // nullable user id
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

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
