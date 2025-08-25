<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    // Relasi dengan jabatan
    public function jabatans()
    {
        return $this->hasMany(Jabatan::class, 'departemen_id');
    }
}
