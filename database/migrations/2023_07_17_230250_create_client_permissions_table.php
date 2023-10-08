<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_client_id');
            $table->foreign('main_client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('sub_client_id');
            $table->foreign('sub_client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('client_permissions');
    }
}
