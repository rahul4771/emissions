<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDetailsReiewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details_reiews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_bank_id')->nullable();
            $table->tinyInteger('bank_sort_code')->nullable();
            $table->tinyInteger('bank_account_number')->nullable();
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
        Schema::dropIfExists('bank_details_reiews');
    }
}
