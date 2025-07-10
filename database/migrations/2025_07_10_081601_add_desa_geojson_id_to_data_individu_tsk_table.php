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
            $table->unsignedBigInteger('desa_geojson_id')->nullable()->after('kelurahan');
            $table->foreign('desa_geojson_id')->references('id')->on('desa_geojson')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropForeign(['desa_geojson_id']);
            $table->dropColumn('desa_geojson_id');
        });
    }
};
