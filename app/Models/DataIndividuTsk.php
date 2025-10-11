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
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
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
        'jumlah_barang_bukti',
        'satuan_barang_bukti',
        'status',
        'residivis',
        'sumber_informasi',
        'desa_geojson_id',
        'ipwl_id',
        'ipwl_compulsary_id',
        'rekomendasi',
        'putusan_pengadilan',
        'noKasus_compulsary',
        'noKasus_prosesHukum',
        'noKasus_narapidana',
        'file_residivis',
        'vonis_residivis',
        'lapas_akhir_residivis',
        'created_by',
        // New Compulsary fields
        'no_kasus',
        'tanggal_kasus',
        'satuan_kerja',
        'aph_menangani',
        'pasal_disangkakan',
        'tkp_lokasi',
        // Proses Hukum Lanjut fields
        'no_kasus_proses',
        'tanggal_kasus_proses',
        'satuan_kerja_proses',
        'aph_menangani_proses',
        'pasal_disangkakan_proses',
        'ipwl_proses_id',
        'rekomendasi_proses',
        // Narapidana fields
        'no_kasus_narapidana',
        'tanggal_kasus_narapidana',
        'satuan_kerja_narapidana',
        'aph_menangani_narapidana',
        'pasal_disangkakan_narapidana',
        'ipwl_narapidana_id',
        'rekomendasi_narapidana'
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
     * Relasi dengan lembaga rehabilitasi IPWL (Voluntary)
     */
    public function ipwlLembaga()
    {
        return $this->belongsTo(LembagaRehabilitasi::class, 'ipwl_id');
    }

    /**
     * Relasi dengan lembaga rehabilitasi IPWL (Compulsary)
     */
    public function ipwlCompulsaryLembaga()
    {
        return $this->belongsTo(LembagaRehabilitasi::class, 'ipwl_compulsary_id');
    }

    /**
     * Relasi dengan lembaga rehabilitasi IPWL (Proses Hukum)
     */
    public function ipwlProsesLembaga()
    {
        return $this->belongsTo(LembagaRehabilitasi::class, 'ipwl_proses_id');
    }

    /**
     * Relasi dengan lembaga rehabilitasi IPWL (Narapidana)
     */
    public function ipwlNarapidanaLembaga()
    {
        return $this->belongsTo(LembagaRehabilitasi::class, 'ipwl_narapidana_id');
    }

    /**
     * Relasi dengan status Compulsary
     */
    public function compulsaryStatus()
    {
        return $this->hasOne(CompulsaryStatus::class, 'individu_id');
    }

    /**
     * Relasi dengan status Proses Hukum Lanjut
     */
    public function prosesHukumStatus()
    {
        return $this->hasOne(ProsesHukumStatus::class, 'individu_id');
    }

    /**
     * Relasi dengan status Narapidana
     */
    public function narapidanaStatus()
    {
        return $this->hasOne(NarapidanaStatus::class, 'individu_id');
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
     * Relasi dengan TKP residivis
     */
    public function tkpResidivis()
    {
        return $this->hasMany(TkpResidivisIndividu::class, 'individu_id');
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

    /**
     * Relasi dengan user yang membuat
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
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
