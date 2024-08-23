<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizingStudieSeparatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizing_studie_separates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizing_studies_id');
            $table->foreign('organizing_studies_id')->references('id')->on('organizing_studies');
            $table->string('day')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('organizing_studie_separates');
    }
}
