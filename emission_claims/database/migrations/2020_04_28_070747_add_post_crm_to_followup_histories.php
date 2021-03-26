<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostCrmToFollowupHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followup_histories', function (Blueprint $table) {
            $table->tinyInteger('post_crm')->default('0')->after('source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followup_histories', function (Blueprint $table) {
            $table->dropColumn('post_crm');
        });
    }
}
