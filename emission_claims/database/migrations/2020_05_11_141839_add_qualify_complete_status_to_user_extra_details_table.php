<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQualifyCompleteStatusToUserExtraDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_extra_details', function (Blueprint $table) {
             $table->tinyInteger('qualify_status')->default('0')->after('unique_key');
             $table->tinyInteger('complete_status')->default('0')->after('unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_extra_details', function (Blueprint $table) {
             $table->dropColumn(['qualify_status', 'complete_status']);
        });
    }
}
