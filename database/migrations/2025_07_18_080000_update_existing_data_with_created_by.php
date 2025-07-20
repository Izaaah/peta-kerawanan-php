<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan kolom created_by ke tabel kasus_narkoba jika belum ada
        if (!Schema::hasColumn('kasus_narkoba', 'created_by')) {
            Schema::table('kasus_narkoba', function (Blueprint $table) {
                $table->unsignedBigInteger('created_by')->nullable()->after('id');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            });
        }

        // Update data lama di data_individu_tsk yang tidak memiliki created_by
        // Berdasarkan kabupaten, assign ke user yang sesuai
        $users = DB::table('users')->where('role', 'administrator')->get();

        foreach ($users as $user) {
            $userKabupaten = $user->name; // diasumsikan nama user = kabupaten/kota

            // Update data individu TSK
            DB::table('data_individu_tsk')
                ->whereNull('created_by')
                ->where('kabupaten', $userKabupaten)
                ->update(['created_by' => $user->id]);
        }

        // Update data lama di tkp_residivis_individu yang tidak memiliki created_by
        // Berdasarkan kabupaten, assign ke user yang sesuai
        foreach ($users as $user) {
            $userKabupaten = $user->name;

            // Update TKP residivis
            DB::table('tkp_residivis_individu')
                ->whereNull('created_by')
                ->where('kabupaten', $userKabupaten)
                ->update(['created_by' => $user->id]);
        }

        // Update data lama di kasus_narkoba yang tidak memiliki created_by
        foreach ($users as $user) {
            $userKabupaten = $user->name;

            // Update kasus narkoba
            DB::table('kasus_narkoba')
                ->whereNull('created_by')
                ->where('kabupaten', $userKabupaten)
                ->update(['created_by' => $user->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kolom created_by dari kasus_narkoba jika ada
        if (Schema::hasColumn('kasus_narkoba', 'created_by')) {
            Schema::table('kasus_narkoba', function (Blueprint $table) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            });
        }
    }
};
