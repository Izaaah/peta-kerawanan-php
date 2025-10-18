<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekVitalSubtype extends Model
{
    use HasFactory;

    protected $table = 'objek_vital_subtypes';

    protected $fillable = [
        'jenis',
        'sub_jenis',
        'slug',
        'description',
        'is_active',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Generate slug from sub_jenis
     */
    public static function generateSlug($jenis, $subJenis)
    {
        return strtolower($jenis) . '_' . strtolower(str_replace([' ', '-'], '_', $subJenis));
    }

    /**
     * Get active subtypes by jenis
     */
    public static function getActiveSubtypes($jenis)
    {
        return self::where('jenis', $jenis)
            ->where('is_active', true)
            ->orderBy('sub_jenis')
            ->get();
    }
}
