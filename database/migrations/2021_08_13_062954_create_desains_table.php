<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desains', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pesanan')->unsigned()->nullable(true);
            $table->foreign('id_pesanan')->references('id')->on('pesanans');
            $table->text('url_desain');
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
        Schema::dropIfExists('desains');
    }
}
