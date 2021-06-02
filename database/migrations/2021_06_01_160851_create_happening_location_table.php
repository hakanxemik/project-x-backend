<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappeningLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('happening_location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('happening_id')->unsigned();

            $table->foreign('location_id')->references('id')->on('locations');
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
        Schema::dropIfExists('happening_location');
    }
}
