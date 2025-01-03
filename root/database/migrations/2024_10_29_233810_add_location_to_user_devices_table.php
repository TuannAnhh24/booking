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
        Schema::table('user_devices', function (Blueprint $table) {
            $table->string('location')->nullable()->after('browser'); // Thêm trường location
        });
    }

    public function down()
    {
        Schema::table('user_devices', function (Blueprint $table) {
            $table->dropColumn('location'); // Xóa trường location khi rollback
        });
    }
};
