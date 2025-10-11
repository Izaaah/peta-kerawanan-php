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
        Schema::create('compulsary_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
            $table->text('no_kasus')->nullable()->comment('Multiple LKN numbers separated by comma');
            $table->date('tanggal_kasus')->nullable();
            $table->string('satuan_kerja')->nullable();
            $table->text('aph_menangani')->nullable()->comment('Multiple APH separated by comma');
            $table->text('pasal_disangkakan')->nullable()->comment('Multiple pasal separated by comma');
            $table->unsignedBigInteger('ipwl_id')->nullable();
            $table->text('rekomendasi')->nullable()->comment('Multiple rekomendasi separated by comma');
            $table->text('tkp_lokasi')->nullable();
            $table->timestamps();

            // Foreign key untuk IPWL
            $table->foreign('ipwl_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');

            // Index untuk performa
            $table->index(['individu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compulsary_status');
    }
};
