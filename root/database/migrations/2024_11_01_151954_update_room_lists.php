<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_lists', function (Blueprint $table) {
            $table->dropColumn('available_from');
            $table->dropColumn('available_to');
            $table->dropColumn('status');
            $table->dropColumn('roomBooking_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_lists', function (Blueprint $table) {
            //
        });
    }
};
