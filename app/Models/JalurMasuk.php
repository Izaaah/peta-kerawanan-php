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
        'kecamatan',        // integer
        'kelurahan',        // integer
        'latitude',         // decimal: koordinat lintang
        'longitude',        // decimal: koordinat bujur
        'transport_type',   // enum: jenis transportasi detail
        'route_name',       // string: nama rute
        'waypoints',        // json: waypoint untuk multi-segment
        'is_multi_segment', // boolean: apakah multi-segment
        'distance_km',      // decimal: jarak dalam km
        'description',      // text: deskripsi
        'color',           // string: warna rute
        'is_active',       // boolean: status aktif
        'created_by',      // nullable user id
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'distance_km' => 'decimal:2',
        'waypoints' => 'array',
        'is_multi_segment' => 'boolean',
        'is_active' => 'boolean',
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

    /**
     * Get transport type options (detailed)
     */
    public static function getTransportTypeOptions()
    {
        return [
            'pesawat' => '✈️ Pesawat',
            'kapal' => '🚢 Kapal Laut',
            'kereta' => '🚂 Kereta Api',
            'mobil' => '🚗 Mobil',
            'motor' => '🏍️ Motor',
            'truk' => '🚚 Truk',
            'bus' => '🚌 Bus'
        ];
    }

    /**
     * Get transport icon
     */
    public static function getTransportIcon($type)
    {
        $icons = [
            'pesawat' => '✈️',
            'kapal' => '🚢',
            'kereta' => '🚂',
            'mobil' => '🚗',
            'motor' => '🏍️',
            'truk' => '🚚',
            'bus' => '🚌'
        ];
        return $icons[$type] ?? '🚗';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
