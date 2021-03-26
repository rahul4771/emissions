<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSplitSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('split_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('domain_name',255)->nullable();
            $table->string('spilt_name',255)->nullable();
            $table->enum('type', ['Both', 'LP', 'Adv'])->default('LP');  
            $table->tinyInteger('section');
            $table->text('description');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('split_settings');
    }
}
