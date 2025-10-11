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
        // Cek apakah tabel tkp_residivis_individu sudah ada
        if (!Schema::hasTable('tkp_residivis_individu')) {
            // Jika belum ada, buat tabel baru
            Schema::create('tkp_residivis_individu', function (Blueprint $table) {
                $table->id();
                $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
                $table->string('provinsi', 100)->nullable();
                $table->string('kabupaten', 100)->nullable();
                $table->string('kecamatan', 100)->nullable();
                $table->string('desa', 100)->nullable();
                $table->string('lokasi', 255)->nullable();
                $table->timestamps();
            });
        } else {
            // Jika tabel sudah ada, hanya tambahkan kolom yang belum ada
            Schema::table('tkp_residivis_individu', function (Blueprint $table) {
                // Cek dan tambahkan kolom yang belum ada
                if (!Schema::hasColumn('tkp_residivis_individu', 'provinsi')) {
                    $table->string('provinsi', 100)->nullable();
                }
                if (!Schema::hasColumn('tkp_residivis_individu', 'kabupaten')) {
                    $table->string('kabupaten', 100)->nullable();
                }
                if (!Schema::hasColumn('tkp_residivis_individu', 'kecamatan')) {
                    $table->string('kecamatan', 100)->nullable();
                }
                if (!Schema::hasColumn('tkp_residivis_individu', 'desa')) {
                    $table->string('desa', 100)->nullable();
                }
                if (!Schema::hasColumn('tkp_residivis_individu', 'lokasi')) {
                    $table->string('lokasi', 255)->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hanya drop tabel jika tabel ini dibuat oleh migration ini
        // Jika tabel sudah ada sebelumnya, hanya hapus kolom yang ditambahkan
        if (Schema::hasTable('tkp_residivis_individu')) {
            Schema::table('tkp_residivis_individu', function (Blueprint $table) {
                // Hapus kolom yang ditambahkan oleh migration ini
                if (Schema::hasColumn('tkp_residivis_individu', 'lokasi')) {
                    $table->dropColumn('lokasi');
                }
                if (Schema::hasColumn('tkp_residivis_individu', 'desa')) {
                    $table->dropColumn('desa');
                }
                if (Schema::hasColumn('tkp_residivis_individu', 'kecamatan')) {
                    $table->dropColumn('kecamatan');
                }
                if (Schema::hasColumn('tkp_residivis_individu', 'kabupaten')) {
                    $table->dropColumn('kabupaten');
                }
                if (Schema::hasColumn('tkp_residivis_individu', 'provinsi')) {
                    $table->dropColumn('provinsi');
                }
            });

            // Catatan: Tidak menghapus tabel sepenuhnya karena mungkin sudah ada sebelumnya
            // Jika ingin menghapus tabel sepenuhnya, uncomment baris di bawah ini:
            // Schema::dropIfExists('tkp_residivis_individu');
        }
    }
};
