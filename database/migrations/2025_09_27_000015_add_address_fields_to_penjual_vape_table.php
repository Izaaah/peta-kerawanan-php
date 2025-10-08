<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjual_vape', function (Blueprint $table) {
            if (!Schema::hasColumn('penjual_vape', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('nama_toko');
            }
            if (!Schema::hasColumn('penjual_vape', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('penjual_vape', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten');
            }
            if (!Schema::hasColumn('penjual_vape', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('penjual_vape', 'provinsi_lain')) {
                $table->string('provinsi_lain')->nullable()->after('kelurahan');
            }
            if (!Schema::hasColumn('penjual_vape', 'kabupaten_lain')) {
                $table->string('kabupaten_lain')->nullable()->after('provinsi_lain');
            }
            if (!Schema::hasColumn('penjual_vape', 'kecamatan_lain')) {
                $table->string('kecamatan_lain')->nullable()->after('kabupaten_lain');
            }
            if (!Schema::hasColumn('penjual_vape', 'kelurahan_lain')) {
                $table->string('kelurahan_lain')->nullable()->after('kecamatan_lain');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penjual_vape', function (Blueprint $table) {
            if (Schema::hasColumn('penjual_vape', 'kelurahan_lain')) {
                $table->dropColumn('kelurahan_lain');
            }
            if (Schema::hasColumn('penjual_vape', 'kecamatan_lain')) {
                $table->dropColumn('kecamatan_lain');
            }
            if (Schema::hasColumn('penjual_vape', 'kabupaten_lain')) {
                $table->dropColumn('kabupaten_lain');
            }
            if (Schema::hasColumn('penjual_vape', 'provinsi_lain')) {
                $table->dropColumn('provinsi_lain');
            }
            if (Schema::hasColumn('penjual_vape', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
            if (Schema::hasColumn('penjual_vape', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }
            if (Schema::hasColumn('penjual_vape', 'kabupaten')) {
                $table->dropColumn('kabupaten');
            }
            if (Schema::hasColumn('penjual_vape', 'provinsi')) {
                $table->dropColumn('provinsi');
            }
        });
    }
};
