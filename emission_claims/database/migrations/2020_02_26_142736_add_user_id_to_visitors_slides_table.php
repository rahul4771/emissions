<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToVisitorsSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors_slides', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('split_id');
            $table->unsignedBigInteger('visitor_id')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors_slides', function (Blueprint $table) {
            $table->dropColumn('user_id','visitor_id');
        });
    }
}
