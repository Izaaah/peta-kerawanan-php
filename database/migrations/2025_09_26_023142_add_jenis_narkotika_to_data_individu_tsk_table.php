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
            $table->string('jenis_narkotika')->nullable(); // Menambahkan kolom jenis_narkotika
        });
    }

    public function down()
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropColumn('jenis_narkotika'); // Menghapus kolom jenis_narkotika jika rollback
        });
    }
};
