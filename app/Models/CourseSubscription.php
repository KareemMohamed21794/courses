<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CourseSubscription extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_EXPIRED = 'expired';

    protected $fillable = [
        'phone_number',
        'name',
        'course_id',
        'subscription_plan_id',
        'status',
        'start_date',
        'end_date',
        'payment_image',
        'approved_by',
        'approved_at',
        'reminder_sent_at',
        'expired_notified_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
        'expired_notified_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function approver()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function getPaymentImageUrlAttribute(): ?string
    {
        if (!$this->payment_image) {
            return null;
        }

        return Storage::disk('public')->url($this->payment_image);
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            self::STATUS_PENDING => 'قيد المراجعة',
            self::STATUS_APPROVED => 'موافق عليه',
            self::STATUS_REJECTED => 'مرفوض',
            self::STATUS_EXPIRED => 'منتهي',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getRemainingDaysAttribute(): ?int
    {
        if ($this->status !== self::STATUS_APPROVED || !$this->end_date) {
            return null;
        }

        $days = Carbon::today()->diffInDays($this->end_date, false);

        return max(0, (int) $days);
    }

    public function isActiveAccess(): bool
    {
        if ($this->status !== self::STATUS_APPROVED || !$this->end_date) {
            return false;
        }

        return $this->end_date->gte(Carbon::today());
    }

    public function scopeActiveAccess($query)
    {
        return $query->where('status', self::STATUS_APPROVED)
            ->whereDate('end_date', '>=', Carbon::today());
    }

    public static function hasActiveAccess(string $phoneNumber, int $courseId): bool
    {
        return static::where('phone_number', $phoneNumber)
            ->where('course_id', $courseId)
            ->activeAccess()
            ->exists();
    }

    public static function hasPendingOrActive(string $phoneNumber, int $courseId): bool
    {
        return static::where('phone_number', $phoneNumber)
            ->where('course_id', $courseId)
            ->where(function ($q) {
                $q->where('status', self::STATUS_PENDING)
                    ->orWhere(function ($active) {
                        $active->where('status', self::STATUS_APPROVED)
                            ->whereDate('end_date', '>=', Carbon::today());
                    });
            })
            ->exists();
    }
}
