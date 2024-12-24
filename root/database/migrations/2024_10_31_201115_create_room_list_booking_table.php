<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_list_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_list_id');
            $table->unsignedBigInteger('booking_id');
            $table->dateTime('available_from');
            $table->dateTime('available_to');
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
        Schema::dropIfExists('room_list_booking');
    }
};
