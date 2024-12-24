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
        Schema::create('category_destination', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Không có khóa ngoại
            $table->unsignedBigInteger('destination_id'); // Không có khóa ngoại
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->string('deleted_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_destination');
    }
};
