<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Log;

class LogSmsProvider implements SmsProviderInterface
{
    public function send(string $phoneNumber, string $message): bool
    {
        Log::info('SMS (log provider)', [
            'phone' => $phoneNumber,
            'message' => $message,
        ]);

        return true;
    }
}
