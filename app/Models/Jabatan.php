<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $fillable = [
        'nama',
        'departemen_id',
        'supervisor_id',
    ];

    // Relasi dengan departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    // Relasi dengan supervisor (jabatan atasan)
    public function supervisor()
    {
        return $this->belongsTo(Jabatan::class, 'supervisor_id');
    }

    // Relasi dengan pegawai
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'jabatan_id');
    }

    // Relasi dengan susunan organisasi
    public function susunanOrganisasi()
    {
        return $this->hasMany(SusunanOrganisasi::class, 'jabatan_id');
    }

    // Relasi ke posisi atasannya di susunan organisasi
    public function parent()
    {
        return $this->hasMany(SusunanOrganisasi::class, 'parent_id');
    }
}
