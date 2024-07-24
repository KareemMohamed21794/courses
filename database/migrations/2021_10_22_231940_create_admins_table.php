<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_super')->default(false);
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('registration_type', ['harah', 'muqiaduh'])->nullable();
            $table->string('alhayyuh_almuqayaduh')->nullable();
            $table->enum('group_classification', ['kashfih', 'irshad'])->nullable();
            $table->string('group_name')->nullable();
            $table->date('date_establishment')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('website')->nullable();
            $table->string('governorate')->nullable();
            $table->string('district')->nullable();
            $table->string('street_name')->nullable();
            $table->string('building_number')->nullable();
            $table->string('workplace')->nullable();
            $table->string('job')->nullable();
            $table->string('leaders_number')->nullable();
            $table->string('persons_number')->nullable();
            $table->string('groups')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
