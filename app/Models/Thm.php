<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thm extends Model
{
    use HasFactory;
    protected $table = 'thm';
    protected $fillable = [
        'nama_thm',
        'ketua_thm',
        'no_hp_ketua',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
