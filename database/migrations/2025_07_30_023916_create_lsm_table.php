<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lsm_narkotika', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->string('nama_lsm', 255);
            $table->string('ketua_lsm', 255);
            $table->text('alamat');
            $table->string('no_hp_ketua', 255);

            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lsm_narkotika');
    }
};
