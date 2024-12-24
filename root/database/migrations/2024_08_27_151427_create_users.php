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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id');
            $table->string('user_name', 50)->nullable();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->tinyInteger('gender')->nullable()->comment('0 is female, 1 is male');
            $table->date('birthday')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('passport', 255)->nullable();
            $table->tinyInteger('status')->nullable()->comment('0 is ban , 1 is active');
            $table->text('description')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
