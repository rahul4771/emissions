<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_bank_id')->nullable();
            $table->integer('user_id');
            $table->string('phone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->enum('type', ['sms', 'email']);
            $table->string('token', 20)->nullable();
            $table->enum('is_signed', ['1', '0'])->default('0');
            $table->enum('questions', ['1', '0'])->default('0');
            $table->enum('bank_details', ['1', '0'])->default('0');
            $table->enum('survey_details', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamp('lead_date')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_bank_id')->references('id')->on('user_banks')
                ->onDelete('cascade');
            $table->index(['user_bank_id', 'status','created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followup_list');
    }
}
