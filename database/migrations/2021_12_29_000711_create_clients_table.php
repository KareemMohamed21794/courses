<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('id_secondary')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('code')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->date('start_date')->nullable();
            $table->string('commercial_registration_no')->nullable();
            $table->string('tax_registration_no')->nullable();
            $table->string('tax_file_no')->nullable();
            $table->string('tax_office')->nullable();
            $table->enum('type', ['personal_relationships', 'international_organizations', 'social_media', 'friends', 'other'])->nullable();
            $table->string('country')->nullable();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('post_number')->nullable();
            $table->string('building_number')->nullable();
            $table->string('street_name')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->enum('client_customer_type', ['male', 'female', 'gov', 'company', 'other'])->nullable();
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
        Schema::dropIfExists('clients');
    }
}
