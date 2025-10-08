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
        Schema::table('thm', function (Blueprint $table) {
            $table->string('provinsi')->nullable()->after('no_hp_ketua');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');
            $table->text('alamat')->nullable()->after('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thm', function (Blueprint $table) {
            $table->dropColumn(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'alamat']);
        });
    }
};
