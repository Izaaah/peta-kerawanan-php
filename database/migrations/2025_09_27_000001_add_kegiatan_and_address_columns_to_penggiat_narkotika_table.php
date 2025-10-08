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
        Schema::table('penggiat_narkotika', function (Blueprint $table) {
            $table->string('kegiatan')->nullable()->after('no_hp');
            $table->string('provinsi')->nullable()->after('kegiatan');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');
            $table->string('provinsi_lain')->nullable()->after('kelurahan');
            $table->string('kabupaten_lain')->nullable()->after('provinsi_lain');
            $table->string('kecamatan_lain')->nullable()->after('kabupaten_lain');
            $table->string('kelurahan_lain')->nullable()->after('kecamatan_lain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penggiat_narkotika', function (Blueprint $table) {
            $table->dropColumn([
                'kegiatan',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan',
                'provinsi_lain',
                'kabupaten_lain',
                'kecamatan_lain',
                'kelurahan_lain'
            ]);
        });
    }
};
