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
        Schema::create('objek_vital_subtypes', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // Industri, Pertambangan, Perhubungan, dll
            $table->string('sub_jenis'); // Nama subjenis yang ditambahkan user
            $table->string('slug')->unique(); // Slug untuk identifikasi unik
            $table->text('description')->nullable(); // Deskripsi opsional
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->index(['jenis', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objek_vital_subtypes');
    }
};
