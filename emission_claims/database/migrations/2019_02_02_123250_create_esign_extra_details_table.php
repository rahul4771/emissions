<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsignExtraDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signature_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('signature_id')->nullable();
            $table->unsignedBigInteger('previous_address_no')->nullable();
            $table->string('previous_postcode',255)->nullable();
            $table->string('previous_address_id',255)->nullable();
            $table->string('previous_address',255)->nullable();
            $table->string('previous_address_line1',255)->nullable();
            $table->string('previous_address_line2',255)->nullable();
            $table->string('previous_address_line3',255)->nullable();
            $table->string('previous_address_city',255)->nullable();
            $table->string('previous_address_province',255)->nullable();
            $table->string('previous_address_country',255)->nullable();
            $table->string('previous_address_company',255)->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('signature_id')->references('id')->on('signatures')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signature_details');
    }
}
