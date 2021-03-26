<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidationEmailTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validation_email_tracking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('visitor_id');
            $table->string('validated_email',50);
            $table->string('result',20);
            $table->text('result_details');
            $table->dateTime('validated_date');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validation_email_tracking');
    }
}
