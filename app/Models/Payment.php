<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'course_id',
        'phone_number',
        'name',
        'payment_image',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function hasApprovedAccess(string $phoneNumber, int $courseId): bool
    {
        return static::where('phone_number', $phoneNumber)
            ->where('course_id', $courseId)
            ->where('status', 'approved')
            ->exists();
    }

    public function getPaymentImageUrlAttribute()
    {
        return asset('storage/' . $this->payment_image);
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'قيد المراجعة',
            'approved' => 'موافق عليه',
            'rejected' => 'مرفوض',
        ];

        return $labels[$this->status] ?? $this->status;
    }
}
