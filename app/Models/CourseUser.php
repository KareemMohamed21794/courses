<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $fillable = [
        'phone_number',
        'name',
        'status',
    ];

    public static function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[^\d+]/', '', $phone);
        $phone = ltrim($phone, '+');

        if (substr($phone, 0, 2) === '00') {
            $phone = substr($phone, 2);
        }

        return $phone;
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
