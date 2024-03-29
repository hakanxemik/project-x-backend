<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('happenings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('offeringsDescription')->nullable();
            $table->dateTime('datetime');
            $table->bigInteger('maxGuests');
            $table->bigInteger('price')->nullable();
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->timestamps();


            $table->foreign('location_id')
                ->references('id')
                ->on('locations');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('type_id')
                ->references('id')
                ->on('happening_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('happening');
    }
}
