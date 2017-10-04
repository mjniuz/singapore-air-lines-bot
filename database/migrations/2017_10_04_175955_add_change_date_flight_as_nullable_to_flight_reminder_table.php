<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChangeDateFlightAsNullableToFlightReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flight_reminder', function (Blueprint $table) {
            $table->dropColumn('date_flight');
        });

        Schema::table('flight_reminder', function (Blueprint $table) {
            $table->date('date_flight')->nullable()->after('to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flight_reminder', function (Blueprint $table) {
            //
        });
    }
}
