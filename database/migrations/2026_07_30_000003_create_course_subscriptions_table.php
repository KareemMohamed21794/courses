<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('course_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('name')->nullable();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('subscription_plan_id')->constrained('subscription_plans')->restrictOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected', 'expired'])->default('pending');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('payment_image')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamp('expired_notified_at')->nullable();
            $table->timestamps();

            $table->index(['phone_number', 'course_id', 'status']);
            $table->index(['status', 'end_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_subscriptions');
    }
}
