<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'twilio' => [
        'enabled' => env('TWILIO_ENABLED', false),
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from' => env('TWILIO_FROM'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SMS Notifications
    |--------------------------------------------------------------------------
    |
    | driver: log | twilio | http
    | Set SMS_ENABLED=true to actually send messages.
    |
    */
    'sms' => [
        'enabled' => env('SMS_ENABLED', env('TWILIO_ENABLED', false)),
        'driver' => env('SMS_DRIVER', 'log'),
        'twilio' => [
            'sid' => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from' => env('TWILIO_FROM'),
        ],
        'http' => [
            'endpoint' => env('SMS_HTTP_ENDPOINT'),
            'api_key' => env('SMS_HTTP_API_KEY'),
            'sender' => env('SMS_HTTP_SENDER'),
        ],
    ],

];
