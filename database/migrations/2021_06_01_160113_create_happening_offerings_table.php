<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappeningOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('happening_offerings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('offering_id')->unsigned();
            $table->bigInteger('happening_id')->unsigned();

            $table->foreign('offering_id')->references('id')->on('offerings');
            $table->foreign('happening_id')->references('id')->on('happenings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('happening_offerings');
    }
}
