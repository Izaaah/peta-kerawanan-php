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
            $table->string('jenis_kelamin', 1)->nullable()->after('nkk');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->date('tgl_lahir')->nullable()->after('tempat_lahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'tempat_lahir', 'tgl_lahir']);
        });
    }
};
