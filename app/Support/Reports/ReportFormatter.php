<?php

namespace App\Support\Reports;

/**
 * Central value formatting so PDF and Excel never drift apart.
 */
class ReportFormatter
{
    public static function currency(float $value): string
    {
        $decimals = (int) config('reports.currency.decimals', 2);
        $symbol = (string) config('reports.currency.symbol', '');
        $thousandsSeparator = (string) config('reports.currency.thousands_separator', ',');

        $amount = number_format($value, $decimals, '.', $thousandsSeparator);

        return $symbol === '' ? $amount : $amount . ' ' . $symbol;
    }

    /** Excel number format code for currency cells. */
    public static function currencyExcelFormat(): string
    {
        $decimals = (int) config('reports.currency.decimals', 2);
        $symbol = (string) config('reports.currency.symbol', '');
        $thousandsSeparator = (string) config('reports.currency.thousands_separator', ',');
        $pattern = ($thousandsSeparator === '' ? '0' : '#,##0')
            . ($decimals > 0 ? '.' . str_repeat('0', $decimals) : '');

        return $symbol === '' ? $pattern : $pattern . ' "' . $symbol . '"';
    }

    /** @param mixed $value */
    public static function date($value): string
    {
        $date = ReportColumn::toDate($value);

        return $date ? $date->format(config('reports.formats.date', 'Y-m-d')) : '';
    }

    /** @param mixed $value */
    public static function dateTime($value): string
    {
        $date = ReportColumn::toDate($value);

        return $date ? $date->format(config('reports.formats.datetime', 'Y-m-d H:i')) : '';
    }

    /** Hex colour (#RRGGBB) to the ARGB string PhpSpreadsheet expects. */
    public static function argb(string $hex): string
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        return 'FF' . strtoupper($hex);
    }
}
