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
        Schema::create('jalur_transportasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalur');
            $table->foreignId('titik_awal_id')->constrained('jalur_masuk')->onDelete('cascade');
            $table->foreignId('titik_tujuan_id')->constrained('jalur_masuk')->onDelete('cascade');
            $table->enum('jenis_transportasi', ['kereta', 'bus', 'pesawat', 'kapal', 'mobil', 'motor']);
            $table->integer('estimasi_waktu')->comment('dalam menit');
            $table->decimal('jarak_km', 8, 2);
            $table->enum('status', ['aktif', 'nonaktif', 'maintenance'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Prevent duplicate routes
            $table->unique(['titik_awal_id', 'titik_tujuan_id', 'jenis_transportasi'], 'unique_route');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalur_transportasi');
    }
};