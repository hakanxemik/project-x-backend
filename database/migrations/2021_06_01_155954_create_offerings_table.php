<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', [
                'alcohol', 'non-alcohol', 'vegan', 'meals',
                'snacks', 'grill', 'cocktails', 'fingerfoods',
                'veggie', 'exotic', 'helal'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerings');
    }
}
