<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_leaders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('leader_name')->nullable();
            $table->enum('current_qualification', ['ghayr_muahal', 'musaeid_qayid_wahdah','qayid_wahda','musaeid_qayid_tadrib','qayid_tadrib'])->nullable();
            $table->date('study_history_mqw')->nullable();
            $table->string('place_study_mqw')->nullable();
            $table->string('organizer_mqw')->nullable();
            $table->date('rent_date_mqw')->nullable();
            $table->string('rent_number_mqw')->nullable();
            $table->date('study_history_qw')->nullable();
            $table->string('place_study_qw')->nullable();
            $table->string('organizer_qw')->nullable();
            $table->date('rent_date_qw')->nullable();
            $table->string('rent_number_qw')->nullable();
            $table->date('study_history_mqt')->nullable();
            $table->string('place_study_mqt')->nullable();
            $table->string('organizer_mqt')->nullable();
            $table->date('rent_date_mqt')->nullable();
            $table->string('rent_number_mqt')->nullable();
            $table->date('study_history_qt')->nullable();
            $table->string('place_study_qt')->nullable();
            $table->string('organizer_qt')->nullable();
            $table->date('rent_date_qt')->nullable();
            $table->string('rent_number_qt')->nullable();
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
        Schema::dropIfExists('qualification_leaders');
    }
}
