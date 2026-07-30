<?php

namespace App\Support\Reports;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

/**
 * Turns a Report into a print-ready A4 PDF.
 *
 * All layout lives in resources/views/reports/pdf, so restyling every report in
 * the system is a single-template change.
 */
class PdfReportRenderer
{
    /** Side margin in points, matching the @page rule in the template (34px). */
    const MARGIN_X = 25.5;

    /** Distance from the bottom of the page to the footer baseline, in points. */
    const FOOTER_BASELINE = 53.0;

    public function html(Report $report): string
    {
        $html = View::make('reports.pdf.document', $this->viewData($report))->render();

        // dompdf neither joins nor reorders Arabic letters, so do it up front.
        return $report->isRtl() ? ArabicShaper::shapeHtml($html) : $html;
    }

    /**
     * @return \Barryvdh\DomPDF\PDF
     */
    public function make(Report $report)
    {
        $pdf = Pdf::setOption('isRemoteEnabled', false)
            ->setOption('defaultFont', config('reports.pdf.font', 'DejaVu Sans'))
            ->setOption('dpi', 96)
            ->loadHTML($this->html($report))
            ->setPaper(config('reports.pdf.paper', 'a4'), $report->getOrientation())
            ->addInfo([
                'Title' => $report->getTitle(),
                'Author' => ReportBranding::name(),
                'Subject' => (string) $report->getSubtitle(),
                'Creator' => ReportBranding::name(),
            ]);

        // The total page count only exists once layout is done.
        $pdf->render();
        $this->stampPageNumbers($pdf->getDomPDF(), $report);

        return $pdf;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function download(Report $report)
    {
        return $this->make($report)->download($report->timestampedFileName() . '.pdf');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function stream(Report $report)
    {
        return $this->make($report)->stream($report->timestampedFileName() . '.pdf');
    }

    /**
     * Draws "page X of Y" in the footer margin of every page.
     *
     * dompdf's CSS "pages" counter is never incremented, so the stamp is added
     * through the canvas, which does know the final page count. For RTL the
     * parts are emitted in visual order because the Arabic is pre-shaped.
     */
    protected function stampPageNumbers(Dompdf $dompdf, Report $report): void
    {
        $canvas = $dompdf->getCanvas();
        $metrics = $dompdf->getFontMetrics();
        $rtl = $report->isRtl();

        $font = $metrics->getFont(config('reports.pdf.font', 'DejaVu Sans'), 'bold');
        if ($font === null) {
            return;
        }

        $size = 7.5;
        $template = $rtl
            ? '{PAGE_COUNT} ' . ArabicShaper::shape('من') . ' {PAGE_NUM} ' . ArabicShaper::shape('صفحة')
            : 'Page {PAGE_NUM} of {PAGE_COUNT}';

        $margin = self::MARGIN_X;
        $baseline = $canvas->get_height() - self::FOOTER_BASELINE;
        $color = $this->rgb(config('reports.theme.text', '#1F2933'));

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) use ($template, $font, $size, $margin, $baseline, $color, $rtl) {
            $text = str_replace(['{PAGE_NUM}', '{PAGE_COUNT}'], [$pageNumber, $pageCount], $template);

            $x = $rtl
                ? $margin
                : $canvas->get_width() - $margin - $fontMetrics->getTextWidth($text, $font, $size);

            $canvas->text($x, $baseline, $text, $font, $size, $color);
        });
    }

    /** @return array{0: float, 1: float, 2: float} */
    protected function rgb(string $hex): array
    {
        $hex = ltrim($hex, '#');

        return [
            hexdec(substr($hex, 0, 2)) / 255,
            hexdec(substr($hex, 2, 2)) / 255,
            hexdec(substr($hex, 4, 2)) / 255,
        ];
    }

    /** @return array<string, mixed> */
    protected function viewData(Report $report): array
    {
        $rtl = $report->isRtl();

        // Chips and summary cards flow left-to-right, so RTL order is mirrored
        // here to keep the first entry on the leading (right-hand) edge.
        $filters = $rtl ? array_reverse($report->getFilters(), true) : $report->getFilters();
        $summary = $rtl ? array_reverse($report->getSummary(), true) : $report->getSummary();

        return [
            'report' => $report,
            'rtl' => $rtl,
            'theme' => config('reports.theme'),
            'tones' => config('reports.tones'),
            'font' => config('reports.pdf.font', 'DejaVu Sans'),
            'company' => ReportBranding::name(),
            'tagline' => ReportBranding::tagline(),
            'logo' => ReportBranding::logoDataUri(),
            'eyebrow' => $rtl ? 'تقرير رسمي' : 'OFFICIAL REPORT',
            'generatedLabel' => $rtl ? 'تاريخ الإصدار' : 'Generated',
            'generatedAt' => now()->format(config('reports.formats.datetime', 'Y-m-d H:i')),
            'footerLine' => $this->footerLine($report, $rtl),
            'filters' => $filters,
            'summary' => $summary,
            'summaryWidth' => count($summary) ? round(100 / count($summary), 2) : 100,
            'columns' => $this->mirror($this->headerCells($report), $rtl),
            'rows' => $this->bodyRows($report, $rtl),
            'totals' => $this->mirror($this->totalCells($report, $rtl), $rtl),
        ];
    }

    /**
     * RTL pages are drawn by a left-to-right layout engine, so the column order
     * is flipped here rather than by the renderer.
     */
    protected function mirror(array $cells, bool $rtl): array
    {
        return $rtl ? array_reverse($cells) : $cells;
    }

    protected function footerLine(Report $report, bool $rtl): string
    {
        $parts = [ReportBranding::name()];

        $contact = ReportBranding::contactLine();
        if ($contact !== '') {
            $parts[] = $contact;
        }

        $parts[] = ($rtl ? 'عدد السجلات' : 'Records') . ': ' . number_format($report->count());

        return implode('  ·  ', $parts);
    }

    /** @return array<int, array<string, mixed>> */
    protected function headerCells(Report $report): array
    {
        $cells = [];

        foreach ($report->getColumns() as $column) {
            $cells[] = [
                'label' => $column->label(),
                'align' => $column->alignment(),
                'width' => $column->widthPercent(),
            ];
        }

        return $cells;
    }

    /** @return array<int, array<int, array<string, mixed>>> */
    protected function bodyRows(Report $report, bool $rtl): array
    {
        $columns = $report->getColumns();
        $matrix = [];

        foreach ($report->getRows() as $row) {
            $cells = [];

            foreach ($columns as $column) {
                $cells[] = [
                    'text' => $column->display($row),
                    'align' => $column->alignment(),
                    'ltr' => $column->isLtr() || $column->isNumeric(),
                    'tone' => $column->type() === ReportColumn::TYPE_STATUS ? $column->tone($row) : null,
                ];
            }

            $matrix[] = $this->mirror($cells, $rtl);
        }

        return $matrix;
    }

    /**
     * The totals row, built in logical order so the "Total" label always lands
     * on the leading edge of the table.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function totalCells(Report $report, bool $rtl): array
    {
        if (!$report->hasTotals()) {
            return [];
        }

        $rows = $report->getRows();
        $cells = [];
        $labelPlaced = false;

        foreach ($report->getColumns() as $column) {
            if ($column->isTotalled()) {
                $cells[] = [
                    'text' => $column->displayTotal($rows),
                    'align' => $column->alignment(),
                    'ltr' => true,
                ];
                continue;
            }

            $cells[] = [
                'text' => $labelPlaced ? '' : ($rtl ? 'الإجمالي' : 'Total'),
                'align' => $labelPlaced ? $column->alignment() : 'start',
                'ltr' => false,
            ];

            $labelPlaced = true;
        }

        return $cells;
    }
}
