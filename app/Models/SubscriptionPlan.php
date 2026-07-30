<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'duration_in_months',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'duration_in_months' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(CourseSubscription::class);
    }

    public function getDurationLabelAttribute(): string
    {
        $labels = [
            3 => 'ربع سنوي (3 أشهر)',
            6 => 'نصف سنوي (6 أشهر)',
            12 => 'سنوي (12 شهر)',
        ];

        return $labels[$this->duration_in_months] ?? $this->duration_in_months . ' شهر';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForCourse($query, int $courseId)
    {
        return $query->where(function ($q) use ($courseId) {
            $q->whereNull('course_id')->orWhere('course_id', $courseId);
        });
    }
}
