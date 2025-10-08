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
        Schema::table('anggarans', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            $table->integer('level')->default(0)->after('parent_id');
            $table->boolean('is_main_activity')->default(false)->after('level');

            $table->foreign('parent_id')->references('id')->on('anggarans')->onDelete('cascade');
            $table->index(['parent_id', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggarans', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id', 'level']);
            $table->dropColumn(['parent_id', 'level', 'is_main_activity']);
        });
    }
};
