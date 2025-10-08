<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name',
        'start_location',
        'start_lat',
        'start_lng',
        'end_location',
        'end_lat',
        'end_lng',
        'transport_type',
        'waypoints',
        'is_multi_segment',
        'distance_km',
        'description',
        'color',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'start_lat' => 'decimal:8',
        'start_lng' => 'decimal:8',
        'end_lat' => 'decimal:8',
        'end_lng' => 'decimal:8',
        'distance_km' => 'decimal:2',
        'waypoints' => 'array',
        'is_multi_segment' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get transport type options
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
        ];
        return $icons[$type] ?? '🚗';
    }

    /**
     * Relationship to User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
