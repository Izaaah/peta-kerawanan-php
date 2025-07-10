<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_individu_tsk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 20);
            $table->string('nkk', 20);
            $table->string('provinsi', 100);
            $table->string('kabupaten', 100);
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);
            $table->text('alamat');
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah', 20)->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu', 20)->nullable();
            $table->enum('peran_jaringan', ['koordinator informan', 'informan', 'kurir', 'gudang', 'broker', 'bandar', 'beking', 'tidak tahu']);
            $table->text('modus_operasi')->nullable();
            $table->text('jenis_narkotika')->nullable();
            $table->enum('skala_kelas', ['dibawah 10gr', 'dibawah1ons', 'dibawah1kg', 'diatas1kg', 'tidak tahu']);
            $table->enum('status', ['Napi', 'Non napi']);
            $table->boolean('residivis')->default(false);
            $table->enum('sumber_informasi', ['informan', 'analisa sosmed', 'analisa aliran dana'])->nullable();
            $table->timestamps();
        });

        Schema::create('telepon_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->string('nomor_telepon', 20);
            $table->timestamps();
        });

        Schema::create('rekening_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->string('no_rekening', 30);
            $table->timestamps();
        });

        Schema::create('ewallet_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->string('no_ewallet', 30);
            $table->timestamps();
        });

        Schema::create('keluarga_lain_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->string('nama_keluarga');
            $table->string('nik', 20);
            $table->timestamps();
        });

        Schema::create('residivis_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->string('aph')->nullable();
            $table->text('pasal')->nullable();
            $table->text('vonis')->nullable();
            $table->string('lapas_akhir')->nullable();
            $table->timestamps();
        });

        Schema::create('foto_individu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->text('file_foto');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_individu');
        Schema::dropIfExists('residivis_detail');
        Schema::dropIfExists('keluarga_lain_individu');
        Schema::dropIfExists('ewallet_individu');
        Schema::dropIfExists('rekening_individu');
        Schema::dropIfExists('telepon_individu');
        Schema::dropIfExists('data_individu_tsk');
    }
};
