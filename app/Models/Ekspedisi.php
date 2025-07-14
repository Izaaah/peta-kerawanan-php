<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'ekspedisi';

    protected $fillable = [
        'nama',
        'manager',
        'alamat',
        'no_hp',
        'jenis',
    ];

    public static function getJenisOptions()
    {
        return [
            'Asperindo' => 'Asperindo',
            'Non Asperindo' => 'Non Asperindo',
        ];
    }
} 