<?php

namespace App\Services;

use App\Models\CourseUser;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function sendApprovalNotification(string $phoneNumber): void
    {
        $message = 'تمت الموافقة على عملية الدفع الخاصة بك ويمكنك الآن تحميل الملفات.';
        $this->send($phoneNumber, $message);
    }

    public function sendRejectionNotification(string $phoneNumber): void
    {
        $message = 'تم رفض عملية الدفع. يرجى التواصل مع الدعم أو إعادة رفع إثبات الدفع.';
        $this->send($phoneNumber, $message);
    }

    protected function send(string $phoneNumber, string $message): void
    {
        if (!config('services.twilio.enabled')) {
            Log::info('Notification skipped (Twilio disabled)', [
                'phone' => $phoneNumber,
                'message' => $message,
            ]);
            return;
        }

        try {
            $sid = config('services.twilio.sid');
            $token = config('services.twilio.token');
            $from = config('services.twilio.from');

            if (!$sid || !$token || !$from) {
                Log::warning('Twilio credentials missing');
                return;
            }

            $client = new \Twilio\Rest\Client($sid, $token);
            $client->messages->create('+' . ltrim($phoneNumber, '+'), [
                'from' => $from,
                'body' => $message,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to send notification', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
