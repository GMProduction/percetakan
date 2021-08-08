<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori')->unsigned()->nullable(true);
            $table->foreign('id_kategori')->references('id')->on('kategoris');
            $table->string('nama_produk');
            $table->text('url_gambar')->nullable(true);
            $table->text('deskripsi');
            $table->integer('biaya_laminasi');
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
        Schema::dropIfExists('produks');
    }
}
