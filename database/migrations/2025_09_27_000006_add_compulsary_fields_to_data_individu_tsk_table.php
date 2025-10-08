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
            $table->unsignedBigInteger('ipwl_compulsary_id')->nullable()->after('ipwl_id');
            $table->text('rekomendasi')->nullable()->after('ipwl_compulsary_id');

            $table->foreign('ipwl_compulsary_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropForeign(['ipwl_compulsary_id']);
            $table->dropColumn(['ipwl_compulsary_id', 'rekomendasi']);
        });
    }
};
