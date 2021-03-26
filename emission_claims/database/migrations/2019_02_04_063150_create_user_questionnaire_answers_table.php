<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionnaireAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_questionnaire_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();;
            $table->unsignedBigInteger('questionnaire_id')->nullable();;
            $table->unsignedBigInteger('questionnaire_option_id')->nullable();
            $table->text('input_answer')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')
                ->onDelete('cascade');
            $table->foreign('questionnaire_option_id')->references('id')->on('questionnaire_options')
                ->onDelete('cascade');
            $table->index(['user_id','questionnaire_id','questionnaire_option_id','status','created_at'],'answers_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_questionnaire_answers');
    }
}
