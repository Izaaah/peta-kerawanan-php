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
            // Add fields for multiple LKN numbers in different sections
            $table->text('noKasus_compulsary')->nullable()->comment('Multiple LKN numbers for Compulsary section');
            $table->text('noKasus_prosesHukum')->nullable()->comment('Multiple LKN numbers for Proses Hukum section');
            $table->text('noKasus_narapidana')->nullable()->comment('Multiple LKN numbers for Narapidana section');

            // Add fields for residivis details
            $table->text('file_residivis')->nullable()->comment('Multiple file paths for residivis');
            $table->text('vonis_residivis')->nullable()->comment('Multiple vonis for residivis');
            $table->text('lapas_akhir_residivis')->nullable()->comment('Multiple lapas akhir for residivis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            $table->dropColumn([
                'noKasus_compulsary',
                'noKasus_prosesHukum',
                'noKasus_narapidana',
                'file_residivis',
                'vonis_residivis',
                'lapas_akhir_residivis'
            ]);
        });
    }
};
