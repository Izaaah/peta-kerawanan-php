<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaRehabilitasi extends Model
{
    use HasFactory;

    protected $table = 'lembaga_rehabilitasi';

    protected $fillable = [
        'nama',
        'jenis',
    ];

    public static function getJenisOptions()
    {
        return ['IPWL', 'Rawat Inap', 'Non Rawat Inap', 'SNI Nasional', 'SNI Reguler'];
    }
} 