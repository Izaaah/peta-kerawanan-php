<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transportation_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->nullable();

            // Old single-segment fields (kept for backward compatibility)
            $table->string('start_location')->nullable();
            $table->decimal('start_lat', 10, 8)->nullable();
            $table->decimal('start_lng', 11, 8)->nullable();
            $table->string('end_location')->nullable();
            $table->decimal('end_lat', 10, 8)->nullable();
            $table->decimal('end_lng', 11, 8)->nullable();
            $table->enum('transport_type', ['pesawat', 'kapal', 'kereta', 'mobil', 'motor', 'truk'])->nullable();

            // New multi-waypoint fields
            $table->json('waypoints')->nullable(); // Array of {location, lat, lng, transport_to_next}
            $table->boolean('is_multi_segment')->default(false);

            $table->decimal('distance_km', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#10B981'); // Hex color for route line
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transportation_routes');
    }
};
