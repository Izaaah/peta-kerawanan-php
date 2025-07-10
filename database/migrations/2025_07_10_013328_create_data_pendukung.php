<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ... sebelumnya tetap

        // --- Tabel 11: objek_vital ---
        Schema::create('objek_vital', function (Blueprint $table) {
            $table->id();
            $table->string('nama_objek');
            $table->string('nama_manager');
            $table->text('lokasi');
            $table->string('no_hp');
            $table->timestamps();
        });

        // --- Tabel 12: penggiat_narkotika ---
        Schema::create('penggiat_narkotika', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_hp');
            $table->timestamps();
        });

        // --- Tabel 13: lembaga_rehabilitasi ---
        Schema::create('lembaga_rehabilitasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', ['IPWL', 'Rawat Inap', 'Non Rawat Inap', 'SNI Nasional', 'SNI Reguler']);
            $table->timestamps();
        });

        // --- Tabel 14: ekspedisi ---
        Schema::create('ekspedisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('manager');
            $table->text('alamat');
            $table->string('no_hp');
            $table->enum('jenis', ['Asperindo', 'Non Asperindo']);
            $table->timestamps();
        });

        // --- Tabel 15: transportasi ---
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transportasi', ['Darat', 'Laut', 'Udara']);
            $table->string('nama_pihak');
            $table->string('posisi')->nullable();
            $table->text('lokasi');
            $table->string('no_hp');
            $table->timestamps();
        });

        // --- Tabel 16: penginapan ---
        Schema::create('penginapan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', ['Hotel', 'Apartemen', 'Losmen', 'Kontrakan', 'Kost']);
            $table->string('nama_pengelola');
            $table->text('lokasi');
            $table->string('no_hp');
            $table->timestamps();
        });

        // --- Tabel 17: akun_medsos_narkotika ---
        Schema::create('akun_medsos_narkotika', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('nama_akun');
            $table->text('link_akun');
            $table->timestamps();
        });

        // --- Tabel 18: perusahaan_farmasi_preksursor ---
        Schema::create('perusahaan_farmasi_preksursor', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['Perusahaan', 'Farmasi']);
            $table->string('nama');
            $table->string('manager');
            $table->text('lokasi');
            $table->string('no_hp');
            $table->text('prekusor');
            $table->text('ijin_penerbit');
            $table->string('jumlah');
            $table->text('tujuan');
            $table->timestamps();
        });

        // --- Tabel 19: penjual_vape ---
        Schema::create('penjual_vape', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('pemilik');
            $table->text('lokasi');
            $table->string('no_hp');
            $table->text('liquid_dicurigai')->nullable();
            $table->text('distributor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
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
