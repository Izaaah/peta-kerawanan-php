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
        Schema::table('medsos', function (Blueprint $table) {
            $table->string('nama_media_sosial_lainnya')->nullable()->after('nama_media_sosial');
            $table->enum('jenis_akun', ['personal', 'kelompok'])->nullable()->after('nama_media_sosial_lainnya');
            $table->unsignedBigInteger('individu_id')->nullable()->after('jenis_akun');
            $table->foreign('individu_id')->references('id')->on('data_individu_tsk')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medsos', function (Blueprint $table) {
            $table->dropForeign(['individu_id']);
            $table->dropColumn(['nama_media_sosial_lainnya', 'jenis_akun', 'individu_id']);
        });
    }
};
