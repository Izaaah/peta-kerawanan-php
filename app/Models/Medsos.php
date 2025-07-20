<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medsos extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'nama_media_sosial',
        'nama_akun',
        'link_akun',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
