<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('activity_name')->nullable();
            $table->enum('nature_activity', ['camp', 'trip','marching','overnight','evening','other'])->nullable();
            $table->text('activity_description')->nullable();
            $table->string('place_activity')->nullable();
            $table->date('activity_history')->nullable();
            $table->string('number_days')->nullable();
            $table->enum('alwahda', ['ashbal', 'kashaf','mutaqadimu','jawaluh','almajmueuh','awlia_alamwr','other'])->nullable();
            $table->text('alwahda_description')->nullable();
            $table->string('activity_leader')->nullable();
            $table->string('number_participants')->nullable();
            $table->string('number_order')->nullable();
            $table->string('number_leader')->nullable();
            $table->text('leaders_names')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('permit_number')->nullable();
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
        Schema::dropIfExists('permits');
    }
}
