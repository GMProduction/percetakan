<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePesanans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table(
            'pesanans',
            function (Blueprint $table) {
                $table->text('url_file');
                $table->longText('custom')->comment('(DC2Type:json)')->nullable(true);
                $table->text('alamat')->nullable(true);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        //
    }
}
