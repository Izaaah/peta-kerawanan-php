<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataIndividuTsk;

class TkpResidivisIndividu extends Model
{
    protected $table = 'tkp_residivis_individu';

    protected $fillable = [
        'individu_id',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'lokasi',
        'created_by'
    ];

    /**
     * Relasi dengan individu
     */
    public function individu()
    {
        return $this->belongsTo(DataIndividuTsk::class, 'individu_id');
    }

    /**
     * Relasi dengan user yang membuat
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
