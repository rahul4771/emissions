<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerApiResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_api_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bank_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('signature_id')->nullable()->default(NULL);
            $table->string('result')->nullable()->default(NULL);
            $table->string('lead_id')->nullable()->default(NULL);
            $table->text('api_response')->nullable()->comment('claimId');
            $table->string('status',255)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index(['user_id','bank_id','signature_id','created_at'],'buyer_api_responses');
            $table->foreign('buyer_id')->references('id')->on('buyer_details')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')
                ->onDelete('cascade');
            $table->foreign('signature_id')->references('id')->on('signatures')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyer_api_responses');
    }
}
