<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // --- Tabel 20: lsm_narkotika ---
        Schema::create('lsm_narkotika', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lsm');
            $table->string('ketua_lsm');
            $table->text('alamat');
            $table->string('no_hp_ketua');
            $table->timestamps();
        });

        // --- Tabel 21: jaringan_rutan_lapas ---
        Schema::create('jaringan_rutan_lapas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_napi');
            $table->enum('jenis_napi', ['Napi Narkotika', 'Napi Non Narkotika']);
            $table->string('lapas');
            $table->text('lokasi_lapas');
            $table->string('peran_dalam_jaringan')->nullable();
            $table->enum('status_proses', ['Ditahan', 'Bebas', 'Dalam proses', 'Tidak diketahui'])->default('Ditahan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jaringan_rutan_lapas');
        Schema::dropIfExists('lsm_narkotika');
        Schema::dropIfExists('penjual_vape');
        Schema::dropIfExists('perusahaan_farmasi_preksursor');
        Schema::dropIfExists('akun_medsos_narkotika');
        Schema::dropIfExists('penginapan');
        Schema::dropIfExists('transportasi');
        Schema::dropIfExists('ekspedisi');
        Schema::dropIfExists('lembaga_rehabilitasi');
        Schema::dropIfExists('penggiat_narkotika');
        Schema::dropIfExists('objek_vital');
        Schema::dropIfExists('manajer_thm');
        Schema::dropIfExists('tempat_hiburan_malam');
        Schema::dropIfExists('jalur_penyelundupan');
        Schema::dropIfExists('foto_individu');
        Schema::dropIfExists('residivis_detail');
        Schema::dropIfExists('keluarga_lain_individu');
        Schema::dropIfExists('ewallet_individu');
        Schema::dropIfExists('rekening_individu');
        Schema::dropIfExists('telepon_individu');
        Schema::dropIfExists('individu_rawan_narkotika');
    }
};
