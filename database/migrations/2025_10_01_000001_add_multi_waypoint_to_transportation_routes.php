<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transportation_routes', function (Blueprint $table) {
            // Check and add waypoints field
            if (!Schema::hasColumn('transportation_routes', 'waypoints')) {
                $table->json('waypoints')->nullable()->after('transport_type');
            }

            // Check and add is_multi_segment field
            if (!Schema::hasColumn('transportation_routes', 'is_multi_segment')) {
                $table->boolean('is_multi_segment')->default(false)->after('waypoints');
            }

            // Make old fields nullable for backward compatibility
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `start_location` VARCHAR(255) NULL');
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `start_lat` DECIMAL(10,8) NULL');
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `start_lng` DECIMAL(11,8) NULL');
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `end_location` VARCHAR(255) NULL');
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `end_lat` DECIMAL(10,8) NULL');
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `end_lng` DECIMAL(11,8) NULL');
            DB::statement('ALTER TABLE `transportation_routes` MODIFY `transport_type` ENUM("pesawat","kapal","kereta","mobil","motor","truk") NULL');
        });
    }

    public function down(): void
    {
        Schema::table('transportation_routes', function (Blueprint $table) {
            if (Schema::hasColumn('transportation_routes', 'waypoints')) {
                $table->dropColumn('waypoints');
            }

            if (Schema::hasColumn('transportation_routes', 'is_multi_segment')) {
                $table->dropColumn('is_multi_segment');
            }
        });
    }
};
