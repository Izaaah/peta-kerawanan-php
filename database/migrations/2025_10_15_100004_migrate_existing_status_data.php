<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate Compulsary data - hanya dari field yang masih ada
        DB::statement("
            INSERT INTO compulsary_status (individu_id, no_kasus, ipwl_id, rekomendasi, created_at, updated_at)
            SELECT
                id as individu_id,
                noKasus_compulsary as no_kasus,
                ipwl_compulsary_id as ipwl_id,
                rekomendasi,
                NOW() as created_at,
                NOW() as updated_at
            FROM data_individu_tsk
            WHERE status = 'Compulsary'
            AND (
                noKasus_compulsary IS NOT NULL OR
                ipwl_compulsary_id IS NOT NULL OR
                rekomendasi IS NOT NULL
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete migrated data
        DB::table('compulsary_status')->truncate();
        DB::table('proses_hukum_status')->truncate();
        DB::table('narapidana_status')->truncate();
    }
};
