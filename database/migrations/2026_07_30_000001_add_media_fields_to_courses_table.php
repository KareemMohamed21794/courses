<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMediaFieldsToCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('instructor')->nullable()->after('description');
            $table->decimal('price', 10, 2)->nullable()->after('instructor');
            $table->string('intro_video')->nullable()->after('thumbnail');
            $table->string('intro_video_type', 20)->nullable()->after('intro_video');
            $table->json('gallery_images')->nullable()->after('intro_video_type');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'instructor',
                'price',
                'intro_video',
                'intro_video_type',
                'gallery_images',
            ]);
        });
    }
}
