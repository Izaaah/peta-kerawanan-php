<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggarans';

    protected $fillable = [
        'akun',
        'kegiatan',
        'anggaran_sebelum',
        'blokir',
        'created_by',
    ];

    protected $casts = [
        'anggaran_sebelum' => 'decimal:2',
        'blokir' => 'decimal:2',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
