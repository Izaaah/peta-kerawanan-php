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
        'created_by',
    ];

    public static function getJenisOptions()
    {
        return ['IPWL', 'Rawat Inap', 'Non Rawat Inap', 'SNI Nasional', 'SNI Reguler'];
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
