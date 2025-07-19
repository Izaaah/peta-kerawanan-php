<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'data_individu_tsk',
            'lsm_narkotika',
            'medsos',
            'penjual_vape',
            'perusahaan_farmasi_preksursor',
            'transportasi',
            'objek_vital',
            'penginapan',
            'ekspedisi',
            'lembaga_rehabilitasi',
            'jaringan_rutan_lapas',
            'penggiat_narkotika',
            'thm',
        ];
        foreach ($tables as $table) {
            if (!Schema::hasColumn($table, 'created_by')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedBigInteger('created_by')->nullable()->after('id');
                    $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'data_individu_tsk',
            'lsm_narkotika',
            'medsos',
            'penjual_vape',
            'perusahaan_farmasi_preksursor',
            'transportasi',
            'objek_vital',
            'penginapan',
            'ekspedisi',
            'lembaga_rehabilitasi',
            'jaringan_rutan_lapas',
            'penggiat_narkotika',
            'thm',
        ];
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign([$table->getTable().'_created_by_foreign']);
                $table->dropColumn('created_by');
            });
        }
    }
};
