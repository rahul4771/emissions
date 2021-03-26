<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerMilestoneStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_milestone_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('partner_signature')->nullable();
            $table->tinyInteger('partner_questions')->nullable();
            $table->tinyInteger('spouses_insurance_number')->nullable();
            $table->tinyInteger('partner_identification_type')->nullable();
            $table->tinyInteger('partner_identification_image')->nullable();
            $table->string('source')->nullable();
            $table->tinyInteger('is_share')->nullable();
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
        Schema::dropIfExists('partner_milestone_stats');
    }
}
