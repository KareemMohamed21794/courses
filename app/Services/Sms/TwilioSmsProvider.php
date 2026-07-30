<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Log;

class TwilioSmsProvider implements SmsProviderInterface
{
    public function send(string $phoneNumber, string $message): bool
    {
        $sid = config('services.sms.twilio.sid');
        $token = config('services.sms.twilio.token');
        $from = config('services.sms.twilio.from');

        if (!$sid || !$token || !$from) {
            Log::warning('Twilio credentials missing');
            return false;
        }

        try {
            $client = new \Twilio\Rest\Client($sid, $token);
            $client->messages->create('+' . ltrim($phoneNumber, '+'), [
                'from' => $from,
                'body' => $message,
            ]);

            return true;
        } catch (\Throwable $e) {
            Log::error('Twilio SMS failed', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
