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
            $table->unsignedBigInteger('ipwl_id')->nullable()->after('sumber_informasi');
            $table->foreign('ipwl_id')->references('id')->on('lembaga_rehabilitasi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropForeign(['ipwl_id']);
            $table->dropColumn('ipwl_id');
        });
    }
};
