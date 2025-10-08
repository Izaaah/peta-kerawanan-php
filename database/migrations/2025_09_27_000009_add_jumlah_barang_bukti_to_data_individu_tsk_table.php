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
            $table->string('jumlah_barang_bukti')->nullable()->after('jenis_narkotika');
            $table->string('satuan_barang_bukti')->nullable()->after('jumlah_barang_bukti');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropColumn(['jumlah_barang_bukti', 'satuan_barang_bukti']);
        });
    }
};
