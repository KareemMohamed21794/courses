<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'instructor',
        'price',
        'thumbnail',
        'intro_video',
        'intro_video_type',
        'gallery_images',
        'pdf_file',
        'video_file',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'gallery_images' => 'array',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptionPlans()
    {
        return $this->hasMany(SubscriptionPlan::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(CourseSubscription::class);
    }

    public function activeSubscriptionPlans()
    {
        return $this->subscriptionPlans()->active()->orderBy('duration_in_months');
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return 'data:image/svg+xml,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="400" height="200"><rect fill="#e9ecef" width="400" height="200"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#adb5bd" font-family="sans-serif" font-size="20">Course</text></svg>');
        }

        return Storage::disk('public')->url($this->thumbnail);
    }

    public function getGalleryImageUrlsAttribute(): array
    {
        $images = $this->gallery_images ?? [];

        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $images);
    }

    public function getIntroVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->intro_video) {
            return null;
        }

        if ($this->intro_video_type === 'file') {
            return Storage::disk('public')->url($this->intro_video);
        }

        $url = $this->intro_video;

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }

        return $url;
    }

    public function hasIntroVideo(): bool
    {
        return !empty($this->intro_video);
    }
}
