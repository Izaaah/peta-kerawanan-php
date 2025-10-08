<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transportasi', function (Blueprint $table) {
            if (!Schema::hasColumn('transportasi', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('nama_pihak');
            }
            if (!Schema::hasColumn('transportasi', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('transportasi', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten');
            }
            if (!Schema::hasColumn('transportasi', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('transportasi', 'provinsi_lain')) {
                $table->string('provinsi_lain')->nullable()->after('kelurahan');
            }
            if (!Schema::hasColumn('transportasi', 'kabupaten_lain')) {
                $table->string('kabupaten_lain')->nullable()->after('provinsi_lain');
            }
            if (!Schema::hasColumn('transportasi', 'kecamatan_lain')) {
                $table->string('kecamatan_lain')->nullable()->after('kabupaten_lain');
            }
            if (!Schema::hasColumn('transportasi', 'kelurahan_lain')) {
                $table->string('kelurahan_lain')->nullable()->after('kecamatan_lain');
            }
            if (!Schema::hasColumn('transportasi', 'alamat')) {
                $table->text('alamat')->nullable()->after('kelurahan_lain');
            }
            if (!Schema::hasColumn('transportasi', 'nama_manager')) {
                $table->string('nama_manager')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('transportasi', 'jabatan')) {
                $table->string('jabatan')->nullable()->after('nama_manager');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transportasi', function (Blueprint $table) {
            if (Schema::hasColumn('transportasi', 'jabatan')) {
                $table->dropColumn('jabatan');
            }
            if (Schema::hasColumn('transportasi', 'nama_manager')) {
                $table->dropColumn('nama_manager');
            }
            if (Schema::hasColumn('transportasi', 'alamat')) {
                $table->dropColumn('alamat');
            }
            if (Schema::hasColumn('transportasi', 'kelurahan_lain')) {
                $table->dropColumn('kelurahan_lain');
            }
            if (Schema::hasColumn('transportasi', 'kecamatan_lain')) {
                $table->dropColumn('kecamatan_lain');
            }
            if (Schema::hasColumn('transportasi', 'kabupaten_lain')) {
                $table->dropColumn('kabupaten_lain');
            }
            if (Schema::hasColumn('transportasi', 'provinsi_lain')) {
                $table->dropColumn('provinsi_lain');
            }
            if (Schema::hasColumn('transportasi', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
            if (Schema::hasColumn('transportasi', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }
            if (Schema::hasColumn('transportasi', 'kabupaten')) {
                $table->dropColumn('kabupaten');
            }
            if (Schema::hasColumn('transportasi', 'provinsi')) {
                $table->dropColumn('provinsi');
            }
        });
    }
};
