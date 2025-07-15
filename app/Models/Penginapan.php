<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;

    protected $table = 'penginapan';

    protected $fillable = [
        'nama',
        'jenis',
        'nama_pengelola',
        'lokasi',
        'no_hp',
    ];

    public static function getJenisOptions()
    {
        return [
            'Hotel' => 'Hotel',
            'Apartemen' => 'Apartemen',
            'Losmen' => 'Losmen',
            'Kontrakan' => 'Kontrakan',
            'Kost' => 'Kost',
        ];
    }
} 