<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hargas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_produk')->unsigned()->nullable(true);
            $table->foreign('id_produk')->references('id')->on('produks');
            $table->bigInteger('id_jenis')->unsigned()->nullable(true);
            $table->foreign('id_jenis')->references('id')->on('jenis_kertas');
            $table->integer('harga');
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
        Schema::dropIfExists('hargas');
    }
}
