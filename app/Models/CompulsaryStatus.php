<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompulsaryStatus extends Model
{
    use HasFactory;

    protected $table = 'compulsary_status';

    protected $fillable = [
        'individu_id',
        'no_kasus',
        'tanggal_kasus',
        'satuan_kerja',
        'aph_menangani',
        'pasal_disangkakan',
        'ipwl_id',
        'rekomendasi',
        'tkp_lokasi'
    ];

    protected $casts = [
        'tanggal_kasus' => 'date',
    ];

    /**
     * Relasi dengan DataIndividuTsk
     */
    public function individu()
    {
        return $this->belongsTo(DataIndividuTsk::class, 'individu_id');
    }

    /**
     * Relasi dengan LembagaRehabilitasi (IPWL)
     */
    public function ipwlLembaga()
    {
        return $this->belongsTo(LembagaRehabilitasi::class, 'ipwl_id');
    }

    /**
     * Accessor untuk mendapatkan array no_kasus
     */
    public function getNoKasusArrayAttribute()
    {
        return $this->no_kasus ? explode(',', $this->no_kasus) : [];
    }

    /**
     * Accessor untuk mendapatkan array aph_menangani
     */
    public function getAphMenanganiArrayAttribute()
    {
        return $this->aph_menangani ? explode(',', $this->aph_menangani) : [];
    }

    /**
     * Accessor untuk mendapatkan array pasal_disangkakan
     */
    public function getPasalDisangkakanArrayAttribute()
    {
        return $this->pasal_disangkakan ? explode(',', $this->pasal_disangkakan) : [];
    }

    /**
     * Accessor untuk mendapatkan array rekomendasi
     */
    public function getRekomendasiArrayAttribute()
    {
        return $this->rekomendasi ? explode(',', $this->rekomendasi) : [];
    }
}
