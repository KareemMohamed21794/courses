<?php

namespace App\Support\Reports;

/**
 * Company identity shared by both renderers.
 */
class ReportBranding
{
    public static function name(): string
    {
        return (string) config('reports.company.name', config('app.name'));
    }

    public static function tagline(): string
    {
        return (string) config('reports.company.tagline', '');
    }

    /** Absolute path of the configured logo, or null when it is missing. */
    public static function logoPath()
    {
        $relative = trim((string) config('reports.company.logo', ''));

        if ($relative === '') {
            return null;
        }

        $path = public_path($relative);

        return is_file($path) ? $path : null;
    }

    /**
     * The logo as a data URI. dompdf cannot reach the filesystem through a URL
     * when remote access is disabled, so it is inlined instead.
     */
    public static function logoDataUri()
    {
        $path = self::logoPath();

        if ($path === null) {
            return null;
        }

        $mime = 'image/png';
        $info = @getimagesize($path);
        if (is_array($info) && !empty($info['mime'])) {
            $mime = $info['mime'];
        }

        return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
    }

    /** Contact lines for the PDF footer, already filtered for emptiness. */
    public static function contactLine(): string
    {
        $parts = array_filter([
            (string) config('reports.company.website', ''),
            (string) config('reports.company.email', ''),
            (string) config('reports.company.phone', ''),
        ]);

        return implode('  |  ', $parts);
    }
}
