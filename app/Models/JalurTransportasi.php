<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurTransportasi extends Model
{
    use HasFactory;

    protected $table = 'jalur_transportasi';

    protected $fillable = [
        'nama_jalur',
        'titik_awal_id',
        'titik_tujuan_id',
        'jenis_transportasi',
        'estimasi_waktu',
        'jarak_km',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'estimasi_waktu' => 'integer', // dalam menit
        'jarak_km' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the starting point
     */
    public function titikAwal()
    {
        return $this->belongsTo(JalurMasuk::class, 'titik_awal_id');
    }

    /**
     * Get the destination point
     */
    public function titikTujuan()
    {
        return $this->belongsTo(JalurMasuk::class, 'titik_tujuan_id');
    }

    /**
     * Get route status options
     */
    public static function getStatusOptions()
    {
        return [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
            'maintenance' => 'Maintenance'
        ];
    }

    /**
     * Get transportation type options
     */
    public static function getJenisTransportasiOptions()
    {
        return [
            'kereta' => 'Kereta Api',
            'bus' => 'Bus',
            'pesawat' => 'Pesawat',
            'kapal' => 'Kapal',
            'mobil' => 'Mobil Pribadi',
            'motor' => 'Motor'
        ];
    }
}