<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizingStudieFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizing_studie_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizing_studies_id');
            $table->foreign('organizing_studies_id')->references('id')->on('organizing_studies');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('organizing_studie_files');
    }
}
