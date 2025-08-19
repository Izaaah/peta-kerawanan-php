<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('komposisi', function (Blueprint $table) {
            $table->id();
            $table->string('bidang');
            $table->unsignedInteger('jumlah_personil')->default(0);
            $table->unsignedInteger('dsp_jumlah')->default(0);
            $table->unsignedInteger('dsp_terisi')->default(0);
            $table->unsignedInteger('dsp_kosong')->default(0);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komposisi');
    }
};
