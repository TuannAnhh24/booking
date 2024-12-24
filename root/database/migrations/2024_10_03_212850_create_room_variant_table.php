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
        Schema::create('room_variant', function (Blueprint $table) {
            $table->id(); // Primary Key: id
            $table->unsignedBigInteger('room_id'); // Foreign Key: room_id
            $table->unsignedBigInteger('variant_id'); // Foreign Key: variant_id
            $table->decimal('price_per_night', 10, 2); // Field: price_per_night
            $table->date('available_from'); // Field: available_from
            $table->date('available_to'); // Field: available_to
            $table->softDeletes(); // Field: deleted_at (for soft deletes)
            $table->timestamps(); // Fields: created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_variant');
    }
};
