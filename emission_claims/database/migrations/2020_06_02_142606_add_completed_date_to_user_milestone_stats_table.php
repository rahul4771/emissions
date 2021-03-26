<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompletedDateToUserMilestoneStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_milestone_stats', function (Blueprint $table) {
            $table->dateTime('completed_date')->after('partner_completed_date')->nullable();
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
            $table->dropColumn('completed_date');
        });
    }
}
