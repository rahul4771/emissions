<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpousesExtraDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_spouses_extra_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('spouses_id')->nullable();
            $table->string('spouses_email')->nullable();
            $table->string('spouses_phone')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('spouses_id')->references('id')->on('user_spouses_details')->onDelete('cascade');
            $table->index(['spouses_id'],'used_indx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_spouses_extra_details');
    }
}
