<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_number');
            $table->string('last_name');
            $table->string('token');

            // found data
            $table->boolean('is_valid')->default(false);
            $table->string('pnr_number');
            $table->string('flight_number');
            $table->string('departure_airport_code');
            $table->string('departure_city');
            $table->string('departure_terminal');
            $table->string('departure_gate');

            $table->string('arrival_airport_code');
            $table->string('arrival_city');
            $table->string('arrival_terminal');
            $table->string('arrival_gate');

            $table->timestamp('flight_schedule_boarding')->nullable();
            $table->timestamp('flight_schedule_departure')->nullable();
            $table->timestamp('flight_schedule_arrival')->nullable();
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
        Schema::dropIfExists('check_in');
    }
}
