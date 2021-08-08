<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bank')->unsigned()->nullable(true);
            $table->foreign('id_bank')->references('id')->on('banks');
            $table->text('url_gambar')->nullable(true);
            $table->bigInteger('id_pesanan')->unsigned()->nullable(true);
            $table->foreign('id_pesanan')->references('id')->on('pesanans');
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
        Schema::dropIfExists('pembayarans');
    }
}
