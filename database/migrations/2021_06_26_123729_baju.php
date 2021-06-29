<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Baju extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baju', function (Blueprint $table) {
            $table->id('idbaju');
            $table->string('gambar');
            $table->string('kodebaju');
            $table->string('nama');
            $table->bigInteger('harga');
            $table->integer('stok');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baju');
    }
}
