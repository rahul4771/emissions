<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSplitInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('split_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->string('split_name',255)->nullable();
            $table->string('split_path',255)->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamp('last_active_date')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('domain_id')->references('id')->on('domain_details')
                ->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('buyer_details')
                ->onDelete('cascade');
            $table->index(['domain_id','buyer_id','status','last_active_date'],'split_info_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('split_info');
    }
}
