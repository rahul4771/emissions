<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_extra_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('postcode',255)->nullable();
            $table->string('street',255)->nullable();
            $table->string('town',255)->nullable();
            $table->string('county',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('housenumber',255)->nullable();
            $table->string('housename',255)->nullable();
            $table->string('address3',255)->nullable();
            $table->string('udprn',255)->nullable();
            $table->string('pz_mailsort',255)->nullable();
            $table->string('deliverypointsuffix',255)->nullable();
            $table->string('addressid',255)->nullable();
            $table->string('previous_name',255)->nullable();  
            $table->string('unique_key',100)->nullable();
            // $table->enum('is_pixel_fire', ['1', '0'])->default('1');
            // $table->enum('is_fb_pixel_fired', ['1', '0'])->default('1');
            // $table->text('pixel_log')->nullable();
            // $table->enum('pixel_type', [ 'IFRAME', 'API', 'MANUAL' ])->default('IFRAME');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'created_at']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_extra_details');
    }
}
