<?php

namespace App\Services\Sms;

use InvalidArgumentException;

class SmsProviderFactory
{
    public static function make(?string $driver = null): SmsProviderInterface
    {
        $driver = $driver ?: config('services.sms.driver', 'log');

        switch ($driver) {
            case 'twilio':
                return new TwilioSmsProvider();
            case 'http':
                return new HttpSmsProvider();
            case 'log':
                return new LogSmsProvider();
            default:
                throw new InvalidArgumentException("Unsupported SMS driver [{$driver}]");
        }
    }
}
