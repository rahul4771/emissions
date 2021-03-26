<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPdfToLeadDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_docs', function (Blueprint $table) {
             $table->string('pdf_file')->after('spouses_identification_image_s3')->nullable();
             $table->string('cover_page')->after('spouses_identification_image_s3')->nullable();
             $table->string('terms_file')->after('spouses_identification_image_s3')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_docs', function (Blueprint $table) {
            $table->dropColumn(['pdf_file', 'cover_page', 'terms_file']);
        });
    }
}
