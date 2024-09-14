<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizingStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizing_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('group_classification')->nullable();
            $table->enum('support_group', ['yes', 'no'])->default('no');
            $table->string('suport_group_id')->nullable();
            $table->string('study_place')->nullable();
            $table->string('study_location')->nullable();
            $table->string('practical_place')->nullable();
            $table->string('practical_location')->nullable();
            $table->string('proposed_time_study')->nullable();
            $table->date('connected_from')->nullable();
            $table->date('connected_to')->nullable();
            $table->string('type_qualification')->nullable();
            $table->string('maximum_number_students')->nullable();
            $table->string('proposed_study_supervisor')->nullable();
            $table->string('qualification_study_supervisor')->nullable();
            $table->string('vacation_number_supervisor')->nullable();
            $table->string('proposed_study_leader')->nullable();
            $table->string('qualification_study_leader')->nullable();
            $table->string('vacation_number_leader')->nullable();
            $table->string('list_supervisor')->nullable();
            $table->string('file')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('reject_notes')->nullable();
            $table->integer('read')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('organizing_studies');
    }
}
