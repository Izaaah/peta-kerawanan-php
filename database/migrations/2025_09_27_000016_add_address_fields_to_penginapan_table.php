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
        Schema::table('penginapan', function (Blueprint $table) {
            if (!Schema::hasColumn('penginapan', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('penginapan', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('penginapan', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten');
            }
            if (!Schema::hasColumn('penginapan', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('penginapan', 'provinsi_lain')) {
                $table->string('provinsi_lain')->nullable()->after('kelurahan');
            }
            if (!Schema::hasColumn('penginapan', 'kabupaten_lain')) {
                $table->string('kabupaten_lain')->nullable()->after('provinsi_lain');
            }
            if (!Schema::hasColumn('penginapan', 'kecamatan_lain')) {
                $table->string('kecamatan_lain')->nullable()->after('kabupaten_lain');
            }
            if (!Schema::hasColumn('penginapan', 'kelurahan_lain')) {
                $table->string('kelurahan_lain')->nullable()->after('kecamatan_lain');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penginapan', function (Blueprint $table) {
            if (Schema::hasColumn('penginapan', 'kelurahan_lain')) {
                $table->dropColumn('kelurahan_lain');
            }
            if (Schema::hasColumn('penginapan', 'kecamatan_lain')) {
                $table->dropColumn('kecamatan_lain');
            }
            if (Schema::hasColumn('penginapan', 'kabupaten_lain')) {
                $table->dropColumn('kabupaten_lain');
            }
            if (Schema::hasColumn('penginapan', 'provinsi_lain')) {
                $table->dropColumn('provinsi_lain');
            }
            if (Schema::hasColumn('penginapan', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
            if (Schema::hasColumn('penginapan', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }
            if (Schema::hasColumn('penginapan', 'kabupaten')) {
                $table->dropColumn('kabupaten');
            }
            if (Schema::hasColumn('penginapan', 'provinsi')) {
                $table->dropColumn('provinsi');
            }
        });
    }
};
