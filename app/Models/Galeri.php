<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'galeri';

    // Tentukan kolom yang dapat diisi secara mass-assignment
    protected $fillable = ['image_path', 'description'];
}
