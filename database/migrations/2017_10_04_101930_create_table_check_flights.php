<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCheckFlights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('from_location');
            $table->string('from_code');
            $table->string('from_airport');
            $table->string('to_location');
            $table->string('to_code');
            $table->string('to_airport');
            $table->datetime('date');
            $table->integer('amount_found');
            $table->integer('travel_time');
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
        Schema::dropIfExists('flights');
    }
}
