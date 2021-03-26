<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->unsignedBigInteger('adv_vis_id')->nullable();
            $table->string('title',100)->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('email',255)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->date('dob')->nullable();
            $table->integer('is_qualified')->default(1);  
            $table->string('response_result',255)->nullable();
            $table->enum('record_status',['TEST', 'LIVE'])->default('LIVE')->nullable();
            $table->timestamp('recent_visit')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('domain_id')->references('id')->on('domain_details')
                ->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitors')
                ->onDelete('cascade');
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
