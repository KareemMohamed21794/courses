<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_leaders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('job')->nullable();
            $table->string('scout')->nullable();
            $table->string('specialization_scout')->nullable();
            $table->string('year_scout')->nullable();
            $table->string('place_scout')->nullable();
            $table->string('vacation_scout')->nullable();
            $table->string('note_scout')->nullable();
            $table->string('academic')->nullable();
            $table->string('specialization_academic')->nullable();
            $table->string('year_academic')->nullable();
            $table->string('college')->nullable();
            $table->string('work_place')->nullable();
            $table->string('phone')->nullable();
            $table->string('Job_title')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('nearest_teacher')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('phone_comunication')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            $table->string('mailbox')->nullable();
            $table->string('city_comunication')->nullable();
            $table->string('zip_code')->nullable();
            $table->integer('read')->default(0);
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
        Schema::dropIfExists('group_leaders');
    }
}
