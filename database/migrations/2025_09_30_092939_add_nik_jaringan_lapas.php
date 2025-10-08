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
        if (!Schema::hasColumn('jaringan_rutan_lapas', 'nik')) {
            Schema::table('jaringan_rutan_lapas', function (Blueprint $table) {
                $table->string('nik', 16)->nullable()->after('nama_napi');
                $table->index('nik');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('jaringan_rutan_lapas', 'nik')) {
            Schema::table('jaringan_rutan_lapas', function (Blueprint $table) {
                // Drop index if exists and then column
                try {
                    $table->dropIndex(['nik']);
                } catch (\Throwable $e) {
                }
                $table->dropColumn('nik');
            });
        }
    }
};
