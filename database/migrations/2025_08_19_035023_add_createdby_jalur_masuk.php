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
            'jalur_masuk',
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
            'jalur_masuk',
        ];
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign([$table->getTable().'_created_by_foreign']);
                $table->dropColumn('created_by');
            });
        }
    }
};
