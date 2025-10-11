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
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            // Fields untuk status "Proses Hukum Lanjut"
            $table->string('no_kasus_proses')->nullable()->after('tkp_lokasi');
            $table->date('tanggal_kasus_proses')->nullable()->after('no_kasus_proses');
            $table->string('satuan_kerja_proses')->nullable()->after('tanggal_kasus_proses');
            $table->text('aph_menangani_proses')->nullable()->after('satuan_kerja_proses');
            $table->text('pasal_disangkakan_proses')->nullable()->after('aph_menangani_proses');
            $table->unsignedBigInteger('ipwl_proses_id')->nullable()->after('pasal_disangkakan_proses');
            $table->text('rekomendasi_proses')->nullable()->after('ipwl_proses_id');

            // Fields untuk status "Narapidana"
            $table->string('no_kasus_narapidana')->nullable()->after('rekomendasi_proses');
            $table->date('tanggal_kasus_narapidana')->nullable()->after('no_kasus_narapidana');
            $table->string('satuan_kerja_narapidana')->nullable()->after('tanggal_kasus_narapidana');
            $table->text('aph_menangani_narapidana')->nullable()->after('satuan_kerja_narapidana');
            $table->text('pasal_disangkakan_narapidana')->nullable()->after('aph_menangani_narapidana');
            $table->unsignedBigInteger('ipwl_narapidana_id')->nullable()->after('pasal_disangkakan_narapidana');
            $table->text('rekomendasi_narapidana')->nullable()->after('ipwl_narapidana_id');

            // Foreign keys untuk IPWL
            $table->foreign('ipwl_proses_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');
            $table->foreign('ipwl_narapidana_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['ipwl_proses_id']);
            $table->dropForeign(['ipwl_narapidana_id']);

            // Drop Proses Hukum Lanjut fields
            $table->dropColumn([
                'no_kasus_proses',
                'tanggal_kasus_proses',
                'satuan_kerja_proses',
                'aph_menangani_proses',
                'pasal_disangkakan_proses',
                'ipwl_proses_id',
                'rekomendasi_proses'
            ]);

            // Drop Narapidana fields
            $table->dropColumn([
                'no_kasus_narapidana',
                'tanggal_kasus_narapidana',
                'satuan_kerja_narapidana',
                'aph_menangani_narapidana',
                'pasal_disangkakan_narapidana',
                'ipwl_narapidana_id',
                'rekomendasi_narapidana'
            ]);
        });
    }
};
