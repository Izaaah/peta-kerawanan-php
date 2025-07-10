<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusNarkoba extends Model
{
    use HasFactory;

    protected $table = 'kasus_narkoba';

    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten',
        'keterangan'
    ];

    public function desa()
    {
        return $this->belongsTo(DesaGeojson::class, 'nama_desa', 'nama_desa');
    }
}
