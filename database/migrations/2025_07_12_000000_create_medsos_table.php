<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('medsos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_media_sosial'); // Facebook, Instagram, dll
            $table->string('nama_akun');
            $table->string('link_akun')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medsos');
    }
};
