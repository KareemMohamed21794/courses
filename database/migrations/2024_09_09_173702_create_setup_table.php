<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup', function (Blueprint $table) {
            $table->id();
            $table->date('dead_line')->nullable();
            $table->date('commander_medal_date')->nullable();
            $table->double('late_cost')->nullable();
            $table->string('secondary_registration_file')->nullable();
            $table->string('administrative_file')->nullable();
            $table->string('financial_file')->nullable();
            $table->string('board_director_meeting_file')->nullable();
            $table->string('commander_medal_file')->nullable();
            $table->string('achievement_study_requirement_file')->nullable();
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
        Schema::dropIfExists('setup');
    }
}
