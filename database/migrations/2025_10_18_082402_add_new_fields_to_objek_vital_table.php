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
        Schema::table('objek_vital', function (Blueprint $table) {
            if (!Schema::hasColumn('objek_vital', 'bidang')) {
                $table->string('bidang')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('objek_vital', 'jenis')) {
                $table->string('jenis')->nullable()->after('bidang');
            }
            if (!Schema::hasColumn('objek_vital', 'sub_jenis')) {
                $table->string('sub_jenis')->nullable()->after('jenis');
            }
            if (!Schema::hasColumn('objek_vital', 'edit_count')) {
                $table->integer('edit_count')->default(0)->after('last_edited_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objek_vital', function (Blueprint $table) {
            if (Schema::hasColumn('objek_vital', 'bidang')) {
                $table->dropColumn('bidang');
            }
            if (Schema::hasColumn('objek_vital', 'jenis')) {
                $table->dropColumn('jenis');
            }
            if (Schema::hasColumn('objek_vital', 'sub_jenis')) {
                $table->dropColumn('sub_jenis');
            }
            if (Schema::hasColumn('objek_vital', 'edit_count')) {
                $table->dropColumn('edit_count');
            }
        });
    }
};
