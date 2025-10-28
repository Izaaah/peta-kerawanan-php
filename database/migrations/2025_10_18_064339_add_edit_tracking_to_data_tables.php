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
        $tables = [
            'data_individu_tsk',
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
            'lsm_narkotika',
        ];

        foreach ($tables as $table) {
            if (!Schema::hasColumn($table, 'edited_by')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedBigInteger('edited_by')->nullable()->after('created_by');
                    $table->foreign('edited_by')->references('id')->on('users')->onDelete('set null');
                });
            }

            if (!Schema::hasColumn($table, 'last_edited_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->timestamp('last_edited_at')->nullable()->after('edited_by');
                });
            }

            if (!Schema::hasColumn($table, 'edit_count')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->integer('edit_count')->default(0)->after('last_edited_at');
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
            'lsm_narkotika',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign([$table->getTable() . '_edited_by_foreign']);
                $table->dropColumn(['edited_by', 'last_edited_at', 'edit_count']);
            });
        }
    }
};
