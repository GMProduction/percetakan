<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_harga')->unsigned()->nullable(true);
            $table->foreign('id_harga')->references('id')->on('hargas');
            $table->bigInteger('id_pelanggan')->unsigned()->nullable(true);
            $table->foreign('id_pelanggan')->references('id')->on('users');
            $table->integer('total_harga');
            $table->tinyInteger('status_bayar');
            $table->tinyInteger('status_pengerjaan');
            $table->date('tanggal_pesan');
            $table->integer('qty');
            $table->integer('biaya_ongkir');
            $table->text('laminasi');
            $table->text('keterangan');
            $table->tinyInteger('status_desain');
            $table->text('url_gambar');
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
        Schema::dropIfExists('pesanans');
    }
}
