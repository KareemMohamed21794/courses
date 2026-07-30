<?php

namespace App\Services\Sms;

interface SmsProviderInterface
{
    public function send(string $phoneNumber, string $message): bool;
}
