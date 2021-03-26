<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserMilestoneStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::create('user_milestone_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('user_signature')->nullable();
            $table->tinyInteger('partner_signature')->nullable();
            $table->tinyInteger('questions')->nullable();
            $table->tinyInteger('partner_details')->nullable();
            $table->tinyInteger('user_insurance_number')->nullable();
            $table->tinyInteger('spouses_insurance_number')->nullable();
            $table->tinyInteger('identification_type')->nullable();
            $table->tinyInteger('identification_image')->nullable();
            $table->tinyInteger('completed')->nullable();
            $table->tinyInteger('sale')->nullable();
            $table->string('source')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_milestone_stats');

    }
}
