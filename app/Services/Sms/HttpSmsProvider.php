<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HttpSmsProvider implements SmsProviderInterface
{
    public function send(string $phoneNumber, string $message): bool
    {
        $endpoint = config('services.sms.http.endpoint');
        $apiKey = config('services.sms.http.api_key');
        $sender = config('services.sms.http.sender');

        if (!$endpoint) {
            Log::warning('HTTP SMS endpoint missing');
            return false;
        }

        try {
            $response = Http::withHeaders(array_filter([
                'Authorization' => $apiKey ? 'Bearer ' . $apiKey : null,
                'Accept' => 'application/json',
            ]))->post($endpoint, [
                'to' => $phoneNumber,
                'from' => $sender,
                'message' => $message,
            ]);

            if (!$response->successful()) {
                Log::error('HTTP SMS failed', [
                    'phone' => $phoneNumber,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('HTTP SMS exception', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
