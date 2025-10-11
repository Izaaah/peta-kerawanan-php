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
            // Add Compulsary fields
            $table->string('no_kasus')->nullable()->after('status');
            $table->date('tanggal_kasus')->nullable()->after('no_kasus');
            $table->string('satuan_kerja')->nullable()->after('tanggal_kasus');
            $table->text('aph_menangani')->nullable()->after('satuan_kerja');
            $table->text('pasal_disangkakan')->nullable()->after('aph_menangani');
            $table->text('tkp_lokasi')->nullable()->after('pasal_disangkakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropColumn([
                'no_kasus',
                'tanggal_kasus',
                'satuan_kerja',
                'aph_menangani',
                'pasal_disangkakan',
                'tkp_lokasi'
            ]);
        });
    }
};
