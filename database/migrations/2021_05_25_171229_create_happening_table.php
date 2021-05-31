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
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamp('date');
            $table->json('location');
            $table->json('category');
            $table->json('offerings');
            $table->bigInteger('max_guests');
            $table->bigInteger('price')->nullable();
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
        Schema::dropIfExists('happening');
    }
}
