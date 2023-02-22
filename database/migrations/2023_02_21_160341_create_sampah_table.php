<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sampah', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('harga_nasabah');
            $table->string('harga_pengepul');
            $table->string('berat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sampah');
    }
};
