<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaGeojson extends Model
{
    use HasFactory;

    protected $table = 'desa_geojson';

    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten',
        'geometry'
    ];

    protected $casts = [
        'geometry' => 'array'
    ];

    public function kasusNarkoba()
    {
        return $this->hasMany(KasusNarkoba::class, 'nama_desa', 'nama_desa');
    }
}
