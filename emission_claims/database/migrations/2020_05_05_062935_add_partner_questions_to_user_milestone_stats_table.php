<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPartnerQuestionsToUserMilestoneStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_milestone_stats', function (Blueprint $table) {
            $table->tinyInteger('partner_questions')->nullable()->after('questions');
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
            $table->dropColumn('partner_questions');

        });
    }
}
