<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddS3fileldsLeadDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_docs', function (Blueprint $table) {
             $table->string('user_identification_image_s3')->after('user_identification_image')->nullable();
             $table->string('spouses_identification_image_s3')->after('spouses_identification_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_docs', function (Blueprint $table) {
            //
        });
    }
}
