<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komposisi extends Model
{
    use HasFactory;

    protected $table = 'komposisi';

    protected $fillable = [
        'bidang',            // string: nama bidang/seksi
        'jumlah_personil',   // integer
        'dsp_jumlah',        // integer
        'dsp_terisi',        // integer
        'dsp_kosong',        // integer
        'keterangan',        // text nullable
        'created_by',        // nullable user id
    ];
}
