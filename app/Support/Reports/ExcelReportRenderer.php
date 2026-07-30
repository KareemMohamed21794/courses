<?php

namespace App\Support\Reports;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Turns a Report into a styled .xlsx workbook.
 *
 * Sheet 1 carries a branded cover block followed by the data table; a second
 * "summary" sheet is added whenever the report has headline figures or column
 * totals worth isolating. Values are written as native numbers and date serials
 * so the workbook stays sortable and summable rather than being flat text.
 */
class ExcelReportRenderer
{
    /** Rows of branding/metadata printed above the table. */
    const COVER_HEIGHT = 8;

    /** @var array<string, string> */
    protected $theme;

    /** @var array<string, array<string, string>> */
    protected $tones;

    public function __construct()
    {
        $this->theme = config('reports.theme');
        $this->tones = config('reports.tones');
    }

    public function download(Report $report): StreamedResponse
    {
        $spreadsheet = $this->build($report);
        $fileName = $report->timestampedFileName() . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            $spreadsheet->disconnectWorksheets();
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0, must-revalidate',
        ]);
    }

    public function build(Report $report): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $this->applyProperties($spreadsheet, $report);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($report->getSheetName());
        $sheet->setRightToLeft($report->isRtl());

        $headerRow = $this->writeCover($sheet, $report);
        $lastRow = $this->writeTable($sheet, $report, $headerRow);

        $this->applyPageSetup($sheet, $report, $headerRow, $lastRow);

        if ($report->getSummary() || $report->hasTotals()) {
            $this->writeSummarySheet($spreadsheet, $report);
        }

        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet;
    }

    protected function applyProperties(Spreadsheet $spreadsheet, Report $report): void
    {
        $spreadsheet->getProperties()
            ->setCreator(ReportBranding::name())
            ->setCompany(ReportBranding::name())
            ->setTitle($report->getTitle())
            ->setSubject((string) $report->getSubtitle())
            ->setDescription('تم إنشاء التقرير بتاريخ ' . now()->format(config('reports.formats.datetime')));
    }

    /**
     * Branded block above the table. Returns the row index the table header
     * should be written to.
     */
    protected function writeCover(Worksheet $sheet, Report $report): int
    {
        $lastColumn = Coordinate::stringFromColumnIndex(max(1, count($report->getColumns())));
        $rtl = $report->isRtl();
        $edge = $rtl ? Alignment::HORIZONTAL_RIGHT : Alignment::HORIZONTAL_LEFT;

        $this->placeLogo($sheet);

        // Company identity.
        $sheet->mergeCells("A1:{$lastColumn}1");
        $sheet->setCellValue('A1', ReportBranding::name());
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)
            ->getColor()->setARGB(ReportFormatter::argb($this->theme['primary']));
        $sheet->getStyle('A1')->getAlignment()->setHorizontal($edge)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->mergeCells("A2:{$lastColumn}2");
        $sheet->setCellValue('A2', ReportBranding::tagline());
        $sheet->getStyle('A2')->getFont()->setSize(9)->setItalic(true)
            ->getColor()->setARGB(ReportFormatter::argb($this->theme['muted']));
        $sheet->getStyle('A2')->getAlignment()->setHorizontal($edge);

        // Title banner.
        $sheet->mergeCells("A4:{$lastColumn}4");
        $sheet->setCellValue('A4', $report->getTitle());
        $sheet->getStyle("A4:{$lastColumn}4")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['argb' => ReportFormatter::argb($this->theme['header_text'])],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => ReportFormatter::argb($this->theme['primary'])],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getRowDimension(4)->setRowHeight(26);

        $subtitle = $report->getSubtitle();
        if ($subtitle) {
            $sheet->mergeCells("A5:{$lastColumn}5");
            $sheet->setCellValue('A5', $subtitle);
            $sheet->getStyle('A5')->getFont()->setSize(9)
                ->getColor()->setARGB(ReportFormatter::argb($this->theme['muted']));
            $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Generation metadata and applied filters.
        $meta = 'تاريخ الإصدار: ' . now()->format(config('reports.formats.datetime'))
            . '     |     عدد السجلات: ' . number_format($report->count());

        $sheet->mergeCells("A6:{$lastColumn}6");
        $sheet->setCellValue('A6', $meta);
        $sheet->getStyle('A6')->getFont()->setSize(9)->setBold(true);
        $sheet->getStyle('A6')->getAlignment()->setHorizontal($edge);

        $sheet->mergeCells("A7:{$lastColumn}7");
        $sheet->setCellValue('A7', 'الفلاتر المطبقة: ' . $this->filtersLine($report));
        $sheet->getStyle('A7')->getFont()->setSize(9)
            ->getColor()->setARGB(ReportFormatter::argb($this->theme['muted']));
        $sheet->getStyle('A7')->getAlignment()->setHorizontal($edge)->setWrapText(true);

        $sheet->getStyle("A6:{$lastColumn}7")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => ReportFormatter::argb($this->theme['primary_soft'])],
            ],
        ]);

        return self::COVER_HEIGHT + 1;
    }

    protected function placeLogo(Worksheet $sheet): void
    {
        $path = ReportBranding::logoPath();

        if ($path === null) {
            return;
        }

        try {
            $drawing = new Drawing();
            $drawing->setName(ReportBranding::name());
            $drawing->setPath($path);
            $drawing->setHeight(40);
            $drawing->setCoordinates('A1');
            $drawing->setOffsetX(4);
            $drawing->setOffsetY(4);
            $drawing->setWorksheet($sheet);
        } catch (\Throwable $e) {
            // A missing or unreadable logo must never break an export.
        }
    }

    protected function filtersLine(Report $report): string
    {
        $filters = $report->getFilters();

        if (!$filters) {
            return 'لا يوجد — التقرير يشمل كل السجلات';
        }

        $parts = [];
        foreach ($filters as $label => $value) {
            $parts[] = $label . ': ' . $value;
        }

        return implode('   |   ', $parts);
    }

    /** Writes the header, body and totals. Returns the last used row. */
    protected function writeTable(Worksheet $sheet, Report $report, int $headerRow): int
    {
        $columns = $report->getColumns();
        $columnCount = max(1, count($columns));
        $lastColumn = Coordinate::stringFromColumnIndex($columnCount);

        // Header.
        foreach ($columns as $index => $column) {
            $sheet->setCellValueByColumnAndRow($index + 1, $headerRow, $column->label());
        }

        $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 10,
                'color' => ['argb' => ReportFormatter::argb($this->theme['header_text'])],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => ReportFormatter::argb($this->theme['header_bg'])],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        $sheet->getRowDimension($headerRow)->setRowHeight(24);

        // Body.
        $rowIndex = $headerRow;
        foreach ($report->getRows() as $offset => $row) {
            $rowIndex++;

            foreach ($columns as $index => $column) {
                $cell = $sheet->getCellByColumnAndRow($index + 1, $rowIndex);
                $cell->setValue($column->excelValue($row));

                $style = $sheet->getStyleByColumnAndRow($index + 1, $rowIndex);
                $style->getNumberFormat()->setFormatCode($column->excelFormat());
                $style->getAlignment()->setHorizontal($this->alignment($column, $report->isRtl()));

                if ($column->type() === ReportColumn::TYPE_STATUS) {
                    $this->paintStatus($style, $column->tone($row));
                }
            }

            if ($offset % 2) {
                $sheet->getStyle("A{$rowIndex}:{$lastColumn}{$rowIndex}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => ReportFormatter::argb($this->theme['zebra'])],
                    ],
                ]);
            }
        }

        $lastDataRow = max($rowIndex, $headerRow);

        if ($report->count() === 0) {
            $lastDataRow = $headerRow + 1;
            $sheet->mergeCells("A{$lastDataRow}:{$lastColumn}{$lastDataRow}");
            $sheet->setCellValue("A{$lastDataRow}", $report->getEmptyMessage());
            $sheet->getStyle("A{$lastDataRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Borders across the whole table.
        $sheet->getStyle("A{$headerRow}:{$lastColumn}{$lastDataRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => ReportFormatter::argb($this->theme['border'])],
                ],
            ],
        ]);

        $lastRow = $lastDataRow;

        if ($report->hasTotals() && $report->count() > 0) {
            $lastRow = $this->writeTotals($sheet, $report, $lastDataRow + 1, $lastColumn);
        }

        $this->sizeColumns($sheet, $columns);

        // Freeze everything above the first data row and switch on filtering.
        $sheet->freezePane('A' . ($headerRow + 1));
        $sheet->setAutoFilter("A{$headerRow}:{$lastColumn}{$lastDataRow}");

        return $lastRow;
    }

    protected function writeTotals(Worksheet $sheet, Report $report, int $row, string $lastColumn): int
    {
        $rows = $report->getRows();
        $labelPlaced = false;

        foreach ($report->getColumns() as $index => $column) {
            $columnIndex = $index + 1;

            if ($column->isTotalled()) {
                $sheet->setCellValueByColumnAndRow($columnIndex, $row, (float) $column->total($rows));
                $sheet->getStyleByColumnAndRow($columnIndex, $row)
                    ->getNumberFormat()->setFormatCode($column->excelFormat());
                continue;
            }

            if (!$labelPlaced) {
                $sheet->setCellValueByColumnAndRow($columnIndex, $row, 'الإجمالي');
                $labelPlaced = true;
            }
        }

        $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => ReportFormatter::argb($this->theme['primary'])],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => ReportFormatter::argb($this->theme['total_bg'])],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => ReportFormatter::argb($this->theme['border'])],
                ],
                'top' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['argb' => ReportFormatter::argb($this->theme['primary'])],
                ],
            ],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(20);

        return $row;
    }

    /** @param ReportColumn[] $columns */
    protected function sizeColumns(Worksheet $sheet, array $columns): void
    {
        foreach ($columns as $index => $column) {
            $letter = Coordinate::stringFromColumnIndex($index + 1);
            $dimension = $sheet->getColumnDimension($letter);

            $width = $column->excelWidthChars();
            if ($width !== null) {
                $dimension->setWidth($width);
                continue;
            }

            $dimension->setAutoSize(true);
        }
    }

    /** @param \PhpOffice\PhpSpreadsheet\Style\Style $style */
    protected function paintStatus($style, string $tone): void
    {
        $colors = isset($this->tones[$tone]) ? $this->tones[$tone] : $this->tones['neutral'];

        $style->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB(ReportFormatter::argb($colors['bg']));
        $style->getFont()->setBold(true)
            ->getColor()->setARGB(ReportFormatter::argb($colors['text']));
    }

    protected function alignment(ReportColumn $column, bool $rtl): string
    {
        switch ($column->alignment()) {
            case 'center':
                return Alignment::HORIZONTAL_CENTER;

            case 'end':
                return $rtl ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_RIGHT;
        }

        return $rtl ? Alignment::HORIZONTAL_RIGHT : Alignment::HORIZONTAL_LEFT;
    }

    protected function applyPageSetup(Worksheet $sheet, Report $report, int $headerRow, int $lastRow): void
    {
        $setup = $sheet->getPageSetup();
        $setup->setPaperSize(PageSetup::PAPERSIZE_A4);
        $setup->setOrientation(
            $report->getOrientation() === 'landscape'
                ? PageSetup::ORIENTATION_LANDSCAPE
                : PageSetup::ORIENTATION_PORTRAIT
        );
        $setup->setFitToWidth(1);
        $setup->setFitToHeight(0);
        $setup->setRowsToRepeatAtTopByStartAndEnd($headerRow, $headerRow);

        $sheet->getPageMargins()->setTop(0.5)->setBottom(0.5)->setLeft(0.4)->setRight(0.4);

        // &P and &N are Excel's page-number / total-pages field codes.
        $sheet->getHeaderFooter()->setOddFooter('&L&"-,Bold"' . ReportBranding::name() . '&R&P / &N');
    }

    /**
     * Headline figures and column totals on their own sheet, so the data sheet
     * stays a clean table that can be pivoted or filtered.
     */
    protected function writeSummarySheet(Spreadsheet $spreadsheet, Report $report): void
    {
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('الملخص');
        $sheet->setRightToLeft($report->isRtl());

        $sheet->getColumnDimension('A')->setWidth(38);
        $sheet->getColumnDimension('B')->setWidth(26);

        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', $report->getTitle());
        $sheet->getStyle('A1:B1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => ['argb' => ReportFormatter::argb($this->theme['header_text'])],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => ReportFormatter::argb($this->theme['primary'])],
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(24);

        $row = 3;
        $row = $this->writeSummaryBlock($sheet, 'معلومات التقرير', [
            'الجهة' => ReportBranding::name(),
            'تاريخ الإصدار' => now()->format(config('reports.formats.datetime')),
            'عدد السجلات' => number_format($report->count()),
            'الفلاتر المطبقة' => $this->filtersLine($report),
        ], $row);

        if ($report->getSummary()) {
            $row = $this->writeSummaryBlock($sheet, 'مؤشرات عامة', $report->getSummary(), $row + 1);
        }

        if ($report->hasTotals()) {
            $totals = [];
            foreach ($report->getColumns() as $column) {
                if ($column->isTotalled()) {
                    $totals[$column->label()] = $column->displayTotal($report->getRows());
                }
            }

            $this->writeSummaryBlock($sheet, 'الإجماليات', $totals, $row + 1);
        }
    }

    /**
     * @param array<string, string> $items
     * @return int The next free row.
     */
    protected function writeSummaryBlock(Worksheet $sheet, string $heading, array $items, int $row): int
    {
        $sheet->mergeCells("A{$row}:B{$row}");
        $sheet->setCellValue("A{$row}", $heading);
        $sheet->getStyle("A{$row}:B{$row}")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => ReportFormatter::argb($this->theme['primary'])]],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => ReportFormatter::argb($this->theme['primary_soft'])],
            ],
        ]);

        $start = $row;
        foreach ($items as $label => $value) {
            $row++;
            $sheet->setCellValue("A{$row}", $label);
            $sheet->setCellValue("B{$row}", $value);
            $sheet->getStyle("A{$row}")->getFont()->setBold(true);
            $sheet->getStyle("B{$row}")->getAlignment()->setWrapText(true);
        }

        $sheet->getStyle("A{$start}:B{$row}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => ReportFormatter::argb($this->theme['border'])],
                ],
            ],
        ]);

        return $row + 1;
    }
}
