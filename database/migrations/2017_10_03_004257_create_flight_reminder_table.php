<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_reminder', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('from');
            $table->string('to');
            $table->date('date_flight');
            $table->decimal('amount',14);

            $table->timestamp('found_at')->nullable();
            $table->decimal('amount_found',14);
            $table->string('airline');
            $table->timestamp('flight_time')->nullable();
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
        Schema::dropIfExists('flight_reminder');
    }
}
