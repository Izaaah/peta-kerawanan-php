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
            // Drop foreign keys first
            $table->dropForeign(['ipwl_proses_id']);
            $table->dropForeign(['ipwl_narapidana_id']);

            // Drop old status-specific columns
            $table->dropColumn([
                'no_kasus',
                'tanggal_kasus',
                'satuan_kerja',
                'aph_menangani',
                'pasal_disangkakan',
                'tkp_lokasi',
                'no_kasus_proses',
                'tanggal_kasus_proses',
                'satuan_kerja_proses',
                'aph_menangani_proses',
                'pasal_disangkakan_proses',
                'ipwl_proses_id',
                'rekomendasi_proses',
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            // Re-add the columns (simplified version)
            $table->string('no_kasus')->nullable()->after('status');
            $table->date('tanggal_kasus')->nullable()->after('no_kasus');
            $table->string('satuan_kerja')->nullable()->after('tanggal_kasus');
            $table->text('aph_menangani')->nullable()->after('satuan_kerja');
            $table->text('pasal_disangkakan')->nullable()->after('aph_menangani');
            $table->text('tkp_lokasi')->nullable()->after('pasal_disangkakan');

            // Add foreign keys back
            $table->foreign('ipwl_proses_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');
            $table->foreign('ipwl_narapidana_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');
        });
    }
};
