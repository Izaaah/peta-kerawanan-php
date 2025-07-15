<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggiatNarkotika extends Model
{
    use HasFactory;
    protected $table = 'penggiat_narkotika';
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
    ];
} 