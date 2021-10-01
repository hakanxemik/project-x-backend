<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappeningTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('happening_type', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('happening_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->timestamps();

            $table->foreign('happening_id')->references('id')->on('happenings');
            $table->foreign('type_id')->references('id')->on('types');
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
