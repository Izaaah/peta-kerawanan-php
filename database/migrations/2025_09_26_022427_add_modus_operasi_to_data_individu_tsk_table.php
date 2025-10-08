<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->string('modus_operasi')->nullable(); // Menambahkan kolom modus_operasi
        });
    }

    public function down()
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropColumn('modus_operasi'); // Menghapus kolom modus_operasi jika rollback
        });
    }
};
