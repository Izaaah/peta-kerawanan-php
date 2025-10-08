<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'url',
        'source',
        'published_at',
        'position'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
