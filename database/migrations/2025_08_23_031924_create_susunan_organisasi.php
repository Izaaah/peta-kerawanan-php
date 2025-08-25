<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSusunanOrganisasi extends Migration
{
    public function up()
    {
        // Tabel departments
        Schema::create('departemen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel positions
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('departemen_id')->constrained('departemen')->onDelete('cascade');
            $table->foreignId('supervisor_id')->nullable()->constrained('jabatan')->onDelete('set null');
            $table->timestamps();
        });

        // Tabel employees
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel org_chart
        Schema::create('susunan_organisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
            $table->foreignId('parent_id')->constrained('jabatan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('susunan_organisasi');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('departemen');
    }
}
