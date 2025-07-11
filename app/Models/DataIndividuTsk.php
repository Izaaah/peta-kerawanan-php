<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataIndividuTsk extends Model
{
    use HasFactory;

    protected $table = 'data_individu_tsk';

    protected $fillable = [
        'nama',
        'nik',
        'nkk',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat',
        'nama_ayah',
        'nik_ayah',
        'nama_ibu',
        'nik_ibu',
        'peran_jaringan',
        'modus_operasi',
        'jenis_narkotika',
        'skala_kelas',
        'status',
        'residivis',
        'sumber_informasi',
        'desa_geojson_id'
    ];

    protected $casts = [
        'residivis' => 'boolean'
    ];

    /**
     * Relasi dengan desa geojson
     */
    public function desaGeojson()
    {
        return $this->belongsTo(DesaGeojson::class, 'desa_geojson_id');
    }

    /**
     * Relasi dengan telepon
     */
    public function telepon()
    {
        return $this->hasMany(TeleponIndividu::class, 'individu_id');
    }

    /**
     * Relasi dengan rekening
     */
    public function rekening()
    {
        return $this->hasMany(RekeningIndividu::class, 'individu_id');
    }

    /**
     * Relasi dengan e-wallet
     */
    public function ewallet()
    {
        return $this->hasMany(EwalletIndividu::class, 'individu_id');
    }

    /**
     * Relasi dengan keluarga lain
     */
    public function keluargaLain()
    {
        return $this->hasMany(KeluargaLainIndividu::class, 'individu_id');
    }

    /**
     * Relasi dengan detail residivis
     */
    public function residivisDetail()
    {
        return $this->hasMany(ResidivisDetail::class, 'individu_id');
    }

    /**
     * Relasi dengan foto
     */
    public function foto()
    {
        return $this->hasMany(FotoIndividu::class, 'individu_id');
    }

    /**
     * Scope untuk filter berdasarkan kabupaten
     */
    public function scopeByKabupaten($query, $kabupaten)
    {
        return $query->where('kabupaten', $kabupaten);
    }

    /**
     * Scope untuk filter berdasarkan kecamatan
     */
    public function scopeByKecamatan($query, $kecamatan)
    {
        return $query->where('kecamatan', $kecamatan);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan peran jaringan
     */
    public function scopeByPeranJaringan($query, $peran)
    {
        return $query->where('peran_jaringan', $peran);
    }

    /**
     * Scope untuk residivis
     */
    public function scopeResidivis($query)
    {
        return $query->where('residivis', true);
    }

    /**
     * Scope untuk non residivis
     */
    public function scopeNonResidivis($query)
    {
        return $query->where('residivis', false);
    }
}

// Model untuk tabel terkait
class TeleponIndividu extends Model
{
    protected $table = 'telepon_individu';
    protected $fillable = ['individu_id', 'nomor_telepon'];
}

class RekeningIndividu extends Model
{
    protected $table = 'rekening_individu';
    protected $fillable = ['individu_id', 'no_rekening'];
}

class EwalletIndividu extends Model
{
    protected $table = 'ewallet_individu';
    protected $fillable = ['individu_id', 'no_ewallet'];
}

class KeluargaLainIndividu extends Model
{
    protected $table = 'keluarga_lain_individu';
    protected $fillable = ['individu_id', 'nama_keluarga', 'nik'];
}

class ResidivisDetail extends Model
{
    protected $table = 'residivis_detail';
    protected $fillable = ['individu_id', 'aph', 'pasal', 'vonis', 'lapas_akhir'];
}

class FotoIndividu extends Model
{
    protected $table = 'foto_individu';
    protected $fillable = ['individu_id', 'file_foto', 'keterangan'];
}
