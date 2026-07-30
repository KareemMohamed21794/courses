<?php

namespace App\Support\Reports;

use Illuminate\Support\Collection;

/**
 * A format-agnostic description of a report.
 *
 * Controllers build one of these and hand it to PdfReportRenderer or
 * ExcelReportRenderer, so a report is defined once and both outputs stay in
 * step. Everything visual lives in config/reports.php and the two renderers.
 *
 *     return Report::make('تقرير الكورسات')
 *         ->filters(['الحالة' => 'نشط'])
 *         ->columns([...])
 *         ->rows($courses)
 *         ->landscape()
 *         ->download('courses');
 */
class Report
{
    /** @var string */
    protected $title;

    /** @var string|null */
    protected $subtitle;

    /** @var array<string, string> Label => value, printed as filter chips. */
    protected $filters = [];

    /** @var ReportColumn[] */
    protected $columns = [];

    /** @var iterable */
    protected $rows = [];

    /** @var array<string, string> Label => value headline figures. */
    protected $summary = [];

    /** @var string */
    protected $orientation = 'portrait';

    /** @var string */
    protected $fileName = 'report';

    /** @var string|null */
    protected $sheetName;

    /** @var string|null */
    protected $note;

    /** @var bool|null Null means "follow config". */
    protected $rtl;

    /** @var string|null Message shown when there are no rows. */
    protected $emptyMessage;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function make(string $title): self
    {
        return new self($title);
    }

    public function subtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Filter chips. Empty, null and "all" values are dropped so reports only
     * advertise the filters that were actually applied.
     *
     * @param array<string, mixed> $filters
     */
    public function filters(array $filters): self
    {
        foreach ($filters as $label => $value) {
            if ($value === null || $value === '' || $value === 'all' || $value === 'All') {
                continue;
            }

            $this->filters[$label] = (string) $value;
        }

        return $this;
    }

    /** @param ReportColumn[] $columns */
    public function columns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    /** @param iterable $rows */
    public function rows($rows): self
    {
        $this->rows = $rows;

        return $this;
    }

    /** @param array<string, mixed> $summary */
    public function summary(array $summary): self
    {
        foreach ($summary as $label => $value) {
            $this->summary[$label] = (string) $value;
        }

        return $this;
    }

    public function landscape(): self
    {
        $this->orientation = 'landscape';

        return $this;
    }

    public function portrait(): self
    {
        $this->orientation = 'portrait';

        return $this;
    }

    public function fileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function sheetName(string $sheetName): self
    {
        $this->sheetName = $sheetName;

        return $this;
    }

    public function note(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function rtl(bool $rtl): self
    {
        $this->rtl = $rtl;

        return $this;
    }

    public function emptyMessage(string $message): self
    {
        $this->emptyMessage = $message;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /** @return array<string, string> */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /** @return ReportColumn[] */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Columns in the order they should be drawn. RTL output is rendered with a
     * left-to-right layout engine (the text is already visually ordered), so
     * the column order is mirrored here instead.
     *
     * @return ReportColumn[]
     */
    public function getVisualColumns(): array
    {
        return $this->isRtl() ? array_reverse($this->columns) : $this->columns;
    }

    public function getRows(): Collection
    {
        return $this->rows instanceof Collection ? $this->rows : collect($this->rows);
    }

    public function count(): int
    {
        return $this->getRows()->count();
    }

    /** @return array<string, string> */
    public function getSummary(): array
    {
        return $this->summary;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getSheetName(): string
    {
        $name = $this->sheetName ?: $this->title;

        // Excel rejects these characters and caps sheet names at 31 chars.
        $name = str_replace(['\\', '/', '?', '*', ':', '[', ']'], ' ', $name);

        return mb_substr(trim($name), 0, 31) ?: 'Report';
    }

    public function getNote()
    {
        return $this->note;
    }

    public function isRtl(): bool
    {
        return $this->rtl === null ? (bool) config('reports.rtl', true) : $this->rtl;
    }

    public function getEmptyMessage(): string
    {
        return $this->emptyMessage ?: 'لا توجد بيانات مطابقة لمعايير البحث المحددة.';
    }

    public function hasTotals(): bool
    {
        foreach ($this->columns as $column) {
            if ($column->isTotalled()) {
                return true;
            }
        }

        return false;
    }

    /** Timestamped download name, without extension. */
    public function timestampedFileName(): string
    {
        return $this->fileName . '-' . now()->format('Ymd-His');
    }
}
