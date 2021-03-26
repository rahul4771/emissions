<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupVendorPixelFiringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_vendor_pixel_firing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('followup_visit_id')->nullable();
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('vendor',255)->nullable();
            $table->enum('page_type', ['LP', 'TY', 'CN'])->default('LP');  
            $table->enum('pixel_type', ['web', 'API'])->default('web'); 
            $table->text('pixel_log')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('followup_visit_id')->references('id')->on('followup_visit')->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['followup_visit_id','visitor_id','user_id','page_type','pixel_type','created_at'],'fvpf_indx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followup_vendor_pixel_firing');
    }
}
