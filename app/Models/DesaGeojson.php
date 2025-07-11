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

    protected $appends = [
        'kerawanan_level',
        'kerawanan_color'
    ];

    /**
     * Relasi dengan kasus narkoba
     */
    public function kasusNarkoba()
    {
        return $this->hasMany(KasusNarkoba::class, 'nama_desa', 'nama_desa');
    }

    /**
     * Relasi dengan data individu TSK
     */
    public function dataIndividuTsk()
    {
        return $this->hasMany(DataIndividuTsk::class, 'desa_geojson_id');
    }

    /**
     * Get kerawanan level berdasarkan jumlah kasus
     */
    public function getKerawananLevelAttribute()
    {
        $kasusCount = $this->kasus_narkoba_count ?? $this->kasusNarkoba()->count();

        if ($kasusCount == 0) return 'Rendah';
        if ($kasusCount <= 5) return 'Sedang';
        if ($kasusCount <= 15) return 'Tinggi';
        return 'Sangat Tinggi';
    }

    /**
     * Get kerawanan color untuk peta
     */
    public function getKerawananColorAttribute()
    {
        $level = $this->kerawanan_level;

        switch ($level) {
            case 'Rendah':
                return '#4ade80'; // green
            case 'Sedang':
                return '#fbbf24'; // yellow
            case 'Tinggi':
                return '#f97316'; // orange
            case 'Sangat Tinggi':
                return '#ef4444'; // red
            default:
                return '#6b7280'; // gray
        }
    }

    /**
     * Scope untuk desa dengan kasus
     */
    public function scopeWithKasus($query)
    {
        return $query->has('kasusNarkoba');
    }

    /**
     * Scope untuk desa tanpa kasus
     */
    public function scopeWithoutKasus($query)
    {
        return $query->doesntHave('kasusNarkoba');
    }

    /**
     * Scope untuk filter berdasarkan kabupaten
     */
    public function scopeByKabupaten($query, $kabupaten)
    {
        return $query->where('kabupaten', $kabupaten);
    }

    /**
     * Scope untuk filter berdasarkan kecamatan
     */
    public function scopeByKecamatan($query, $kecamatan)
    {
        return $query->where('kecamatan', $kecamatan);
    }

    /**
     * Get statistik desa
     */
    public static function getStats()
    {
        return [
            'total_desa' => self::count(),
            'desa_dengan_kasus' => self::has('kasusNarkoba')->count(),
            'desa_tanpa_kasus' => self::doesntHave('kasusNarkoba')->count(),
            'total_kasus' => KasusNarkoba::count(),
            'kabupaten_count' => self::distinct('kabupaten')->count(),
            'kecamatan_count' => self::distinct('kecamatan')->count(),
        ];
    }

    /**
     * Get daftar kabupaten
     */
    public static function getKabupatenList()
    {
        return self::distinct('kabupaten')
            ->pluck('kabupaten')
            ->sort()
            ->values();
    }

    /**
     * Get daftar kecamatan
     */
    public static function getKecamatanList($kabupaten = null)
    {
        $query = self::distinct('kecamatan');

        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }

        return $query->pluck('kecamatan')->sort()->values();
    }
}
