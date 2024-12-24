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
        Schema::table('review', function (Blueprint $table) {
            if (!Schema::hasColumn('review', 'staff_rating')) {
                $table->float('staff_rating')->nullable()->after('deleted_at');
            }
            if (!Schema::hasColumn('review', 'comfort_rating')) {
                $table->float('comfort_rating')->nullable()->after('staff_rating');
            }
            if (!Schema::hasColumn('review', 'amenities_rating')) {
                $table->float('amenities_rating')->nullable()->after('comfort_rating');
            }
            if (!Schema::hasColumn('review', 'value_for_money_rating')) {
                $table->float('value_for_money_rating')->nullable()->after('amenities_rating');
            }
            if (!Schema::hasColumn('review', 'location_rating')) {
                $table->float('location_rating')->nullable()->after('value_for_money_rating');
            }
            if (!Schema::hasColumn('review', 'cleanliness_rating')) {
                $table->float('cleanliness_rating')->nullable()->after('location_rating');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review', function (Blueprint $table) {
            
        });
    }
};
