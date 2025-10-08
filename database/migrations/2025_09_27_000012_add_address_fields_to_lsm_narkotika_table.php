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
        Schema::table('lsm_narkotika', function (Blueprint $table) {
            $table->string('provinsi')->nullable()->after('ketua_lsm');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');
            $table->string('no_telp')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lsm_narkotika', function (Blueprint $table) {
            $table->dropColumn(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'no_telp']);
        });
    }
};
