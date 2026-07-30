<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Company identity
    |--------------------------------------------------------------------------
    |
    | Printed in the header of every PDF and on the cover block of every Excel
    | export. "logo" is resolved against public_path() and is optional.
    |
    */

    'company' => [
        'name' => env('REPORT_COMPANY_NAME', 'منصة الكورسات'),
        'tagline' => env('REPORT_COMPANY_TAGLINE', 'نظام إدارة الكورسات والاشتراكات'),
        'logo' => env('REPORT_COMPANY_LOGO', 'images/logo.png'),
        'website' => env('REPORT_COMPANY_WEBSITE', ''),
        'phone' => env('REPORT_COMPANY_PHONE', ''),
        'email' => env('REPORT_COMPANY_EMAIL', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Direction
    |--------------------------------------------------------------------------
    |
    | Reports are laid out right-to-left by default because the admin panel is
    | Arabic. Individual reports may override this with Report::direction().
    |
    */

    'rtl' => true,

    'currency' => [
        'symbol' => env('REPORT_CURRENCY_SYMBOL', ''),
        'decimals' => 2,
        'thousands_separator' => '',
    ],

    'formats' => [
        'date' => 'Y-m-d',
        'datetime' => 'Y-m-d H:i',
        'time' => 'H:i',
    ],

    /*
    |--------------------------------------------------------------------------
    | Design tokens
    |--------------------------------------------------------------------------
    |
    | Shared by the PDF stylesheet and the Excel styler so both formats keep the
    | same visual language. Colours are plain hex; the Excel renderer converts
    | them to ARGB automatically.
    |
    */

    'theme' => [
        'primary' => '#12355B',
        'primary_soft' => '#E8EEF6',
        'accent' => '#1AA179',
        'text' => '#1F2933',
        'muted' => '#6B7A8D',
        'border' => '#D3DCE6',
        'header_bg' => '#12355B',
        'header_text' => '#FFFFFF',
        'zebra' => '#F5F8FC',
        'total_bg' => '#E8EEF6',
        'page_bg' => '#FFFFFF',
    ],

    /*
    | Status pill palette, keyed by "tone". Reports refer to tones by name so a
    | palette change here restyles every report at once.
    */

    'tones' => [
        'neutral' => ['bg' => '#EEF1F5', 'text' => '#4B5A6B'],
        'success' => ['bg' => '#E3F6EE', 'text' => '#14795A'],
        'warning' => ['bg' => '#FFF3DC', 'text' => '#95651B'],
        'danger' => ['bg' => '#FDE8E8', 'text' => '#9B2C2C'],
        'info' => ['bg' => '#E6F0FB', 'text' => '#1A4E8A'],
    ],

    'pdf' => [
        'paper' => 'a4',
        'font' => 'DejaVu Sans',
    ],

];
