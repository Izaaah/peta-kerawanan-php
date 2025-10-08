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
        Schema::table('lembaga_rehabilitasi', function (Blueprint $table) {
            // Add new fields for the updated form structure
            $table->string('jenis_lrehab')->nullable()->after('nama'); // LRIP or LRKM
            $table->string('nama_ketua')->nullable()->after('jenis_lrehab');
            $table->string('no_hp')->nullable()->after('nama_ketua');

            // Address fields
            $table->string('provinsi')->nullable()->after('no_hp');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');
            $table->string('provinsi_lain')->nullable()->after('kelurahan');
            $table->string('kabupaten_lain')->nullable()->after('provinsi_lain');
            $table->string('kecamatan_lain')->nullable()->after('kabupaten_lain');
            $table->string('kelurahan_lain')->nullable()->after('kecamatan_lain');
            $table->text('alamat')->nullable()->after('kelurahan_lain');

            // Certification fields
            $table->json('sertifikasi')->nullable()->after('alamat'); // Store array of certifications
            $table->string('nomor_sni_nasional')->nullable()->after('sertifikasi');
            $table->string('nomor_sni_reguler')->nullable()->after('nomor_sni_nasional');

            // Remove the old jenis enum field since we're replacing it with checkboxes
            $table->dropColumn('jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lembaga_rehabilitasi', function (Blueprint $table) {
            // Restore the old jenis field
            $table->enum('jenis', ['IPWL', 'Rawat Inap', 'Non Rawat Inap', 'SNI Nasional', 'SNI Reguler'])->after('nama');

            // Drop the new fields
            $table->dropColumn([
                'jenis_lrehab',
                'nama_ketua',
                'no_hp',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan',
                'provinsi_lain',
                'kabupaten_lain',
                'kecamatan_lain',
                'kelurahan_lain',
                'alamat',
                'sertifikasi',
                'nomor_sni_nasional',
                'nomor_sni_reguler'
            ]);
        });
    }
};
