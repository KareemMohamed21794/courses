<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoutExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scout_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_leader_id');
            $table->foreign('group_leader_id')->references('id')->on('group_leaders');
            $table->string('place')->nullable();
            $table->string('mission')->nullable();
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('reason_leave')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scout_experiences');
    }
}
