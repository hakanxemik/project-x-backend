<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappeningTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('happening_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('happening_id')->unsigned();

            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::dropIfExists('happening_type');
    }
}
