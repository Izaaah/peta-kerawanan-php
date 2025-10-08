<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggarans';

    protected $fillable = [
        'akun',
        'kegiatan',
        'anggaran_sebelum',
        'blokir',
        'created_by',
        'parent_id',
        'level',
        'is_main_activity',
    ];

    protected $casts = [
        'anggaran_sebelum' => 'decimal:2',
        'blokir' => 'decimal:2',
        'is_main_activity' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi hierarkis
    public function parent()
    {
        return $this->belongsTo(Anggaran::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Anggaran::class, 'parent_id');
    }

    // Scope untuk mendapatkan data hierarkis
    public function scopeMainActivities($query)
    {
        return $query->where('is_main_activity', true)->whereNull('parent_id');
    }

    public function scopeSubActivities($query)
    {
        return $query->where('is_main_activity', false)->whereNotNull('parent_id');
    }

    // Method untuk menghitung total dari children
    public function getTotalAnggaranSebelumAttribute()
    {
        if ($this->is_main_activity && $this->relationLoaded('children')) {
            return $this->children->sum('anggaran_sebelum');
        }
        return $this->anggaran_sebelum;
    }

    public function getTotalBlokirAttribute()
    {
        if ($this->is_main_activity && $this->relationLoaded('children')) {
            return $this->children->sum('blokir');
        }
        return $this->blokir ?? 0;
    }

    public function getTotalAnggaranSetelahAttribute()
    {
        if ($this->is_main_activity && $this->relationLoaded('children')) {
            return $this->getTotalAnggaranSebelumAttribute() - $this->getTotalBlokirAttribute();
        }
        return $this->anggaran_sebelum - ($this->blokir ?? 0);
    }
}
