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
        Schema::table('penjual_vape', function (Blueprint $table) {
            // Change liquid_dicurigai from text to text to store comma-separated values
            $table->text('liquid_dicurigai')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjual_vape', function (Blueprint $table) {
            // Revert back to original text field
            $table->text('liquid_dicurigai')->nullable()->change();
        });
    }
};
