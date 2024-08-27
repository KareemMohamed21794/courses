<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('home_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('nationality')->nullable();
            $table->string('parents_status')->nullable();
            $table->string('education_level')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('health_condition')->nullable();
            $table->string('health_condition_type')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('street')->nullable();
            $table->string('nearest_teacher')->nullable();
            $table->string('building_number')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('division')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_phone_2')->nullable();
            $table->string('guardian_job')->nullable();
            $table->string('relative_relation')->nullable();
            $table->string('guardian_place_work')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('identifier_name')->nullable();
            $table->string('identifier_phone')->nullable();
            $table->string('notes')->nullable();
            $table->string('text_note')->nullable();
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
        Schema::dropIfExists('student_registrations');
    }
}
