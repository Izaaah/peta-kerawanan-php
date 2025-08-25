<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SusunanOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'susunan_organisasi';

    protected $fillable = [
        'jabatan_id',
        'parent_id',
    ];

    // Relasi dengan jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    // Relasi dengan parent jabatan
    public function parent()
    {
        return $this->belongsTo(Jabatan::class, 'parent_id');
    }
}
