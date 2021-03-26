<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserMilestoneStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_milestone_stats', function (Blueprint $table) {
            $table->tinyInteger('user_completed')->after('source')->nullable();
            $table->tinyInteger('partner_completed')->after('user_completed')->nullable();
            $table->dateTime('user_completed_date')->after('partner_completed')->nullable();
            $table->dateTime('partner_completed_date')->after('user_completed_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_milestone_stats', function (Blueprint $table) {
            //
        });
    }
}
