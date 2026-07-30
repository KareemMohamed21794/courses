<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Support\Reports\ExcelReportRenderer;
use App\Support\Reports\PdfReportRenderer;
use App\Support\Reports\Report;
use Illuminate\Http\Request;

/**
 * Gives an admin controller a single entry point for exporting a Report in
 * whichever format the request asked for.
 */
trait ExportsReports
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function exportReport(Report $report, Request $request)
    {
        $format = strtolower((string) $request->input('format', 'pdf'));

        if (in_array($format, ['excel', 'xlsx', 'xls'], true)) {
            return app(ExcelReportRenderer::class)->download($report);
        }

        $renderer = app(PdfReportRenderer::class);

        // ?preview=1 opens the PDF in the browser instead of downloading it.
        return $request->boolean('preview')
            ? $renderer->stream($report)
            : $renderer->download($report);
    }

    /**
     * Human-readable filter values for the report header, resolved from a map
     * of raw request values to labels.
     *
     * @param mixed $value
     * @param array<string, string> $labels
     */
    protected function filterLabel($value, array $labels, string $default = ''): string
    {
        if ($value === null || $value === '' || $value === 'all') {
            return $default;
        }

        $key = (string) $value;

        return isset($labels[$key]) ? $labels[$key] : $key;
    }
}
