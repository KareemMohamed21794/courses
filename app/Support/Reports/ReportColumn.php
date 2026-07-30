<?php

namespace App\Support\Reports;

use Carbon\Carbon;
use DateTimeInterface;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/**
 * One column of a report.
 *
 * A column knows how to pull a value out of a row and how to present it twice:
 * as a formatted string for the PDF, and as a native value plus a number format
 * for Excel (so spreadsheets stay sortable and summable).
 */
class ReportColumn
{
    const TYPE_TEXT = 'text';
    const TYPE_NUMBER = 'number';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_CURRENCY = 'currency';
    const TYPE_DATE = 'date';
    const TYPE_DATETIME = 'datetime';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_STATUS = 'status';

    /** @var string */
    protected $key;

    /** @var string */
    protected $label;

    /** @var string */
    protected $type;

    /** @var string|null */
    protected $align;

    /** @var float|null Share of the table width, in percent. */
    protected $width;

    /** @var int|null Excel column width, in characters. */
    protected $excelWidth;

    /** @var bool */
    protected $totalled = false;

    /** @var callable|null */
    protected $resolver;

    /** @var array<string, array{0: string, 1: string}> value => [label, tone] */
    protected $statuses = [];

    /** @var array{0: string, 1: string} */
    protected $booleanLabels = ['نعم', 'لا'];

    /** @var string */
    protected $placeholder = '—';

    /** @var bool Render the value left-to-right (phones, emails, URLs). */
    protected $ltr = false;

    protected function __construct(string $key, string $label, string $type)
    {
        $this->key = $key;
        $this->label = $label;
        $this->type = $type;
    }

    public static function text(string $key, string $label): self
    {
        return new self($key, $label, self::TYPE_TEXT);
    }

    public static function number(string $key, string $label): self
    {
        return new self($key, $label, self::TYPE_NUMBER);
    }

    public static function decimal(string $key, string $label): self
    {
        return new self($key, $label, self::TYPE_DECIMAL);
    }

    public static function currency(string $key, string $label): self
    {
        return new self($key, $label, self::TYPE_CURRENCY);
    }

    public static function date(string $key, string $label): self
    {
        return new self($key, $label, self::TYPE_DATE);
    }

    public static function datetime(string $key, string $label): self
    {
        return new self($key, $label, self::TYPE_DATETIME);
    }

    public static function boolean(string $key, string $label, string $whenTrue = 'نعم', string $whenFalse = 'لا'): self
    {
        $column = new self($key, $label, self::TYPE_BOOLEAN);
        $column->booleanLabels = [$whenTrue, $whenFalse];

        return $column;
    }

    /**
     * A colour-coded pill. $statuses maps a raw value to [label, tone], where
     * tone is one of the keys in config('reports.tones').
     *
     * @param array<string, array{0: string, 1: string}> $statuses
     */
    public static function status(string $key, string $label, array $statuses): self
    {
        $column = new self($key, $label, self::TYPE_STATUS);
        $column->statuses = $statuses;

        return $column;
    }

    public function width(float $percent): self
    {
        $this->width = $percent;

        return $this;
    }

    public function excelWidth(int $characters): self
    {
        $this->excelWidth = $characters;

        return $this;
    }

    public function align(string $align): self
    {
        $this->align = $align;

        return $this;
    }

    /** Include this column in the totals row. */
    public function totalled(bool $totalled = true): self
    {
        $this->totalled = $totalled;

        return $this;
    }

    /** @param callable $resolver fn(mixed $row): mixed */
    public function using(callable $resolver): self
    {
        $this->resolver = $resolver;

        return $this;
    }

    public function ltr(bool $ltr = true): self
    {
        $this->ltr = $ltr;

        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function widthPercent()
    {
        return $this->width;
    }

    public function excelWidthChars()
    {
        return $this->excelWidth;
    }

    public function isTotalled(): bool
    {
        return $this->totalled;
    }

    public function isLtr(): bool
    {
        return $this->ltr;
    }

    public function isNumeric(): bool
    {
        return in_array($this->type, [self::TYPE_NUMBER, self::TYPE_DECIMAL, self::TYPE_CURRENCY], true);
    }

    public function isTemporal(): bool
    {
        return in_array($this->type, [self::TYPE_DATE, self::TYPE_DATETIME], true);
    }

    /** Column alignment; numbers and dates centre by default. */
    public function alignment(): string
    {
        if ($this->align !== null) {
            return $this->align;
        }

        if ($this->isNumeric()) {
            return 'end';
        }

        if ($this->isTemporal() || $this->type === self::TYPE_STATUS || $this->type === self::TYPE_BOOLEAN) {
            return 'center';
        }

        return 'start';
    }

    /**
     * The untouched value behind the column, used for totals and for Excel.
     *
     * @param mixed $row
     * @return mixed
     */
    public function raw($row)
    {
        if ($this->resolver !== null) {
            return call_user_func($this->resolver, $row);
        }

        return data_get($row, $this->key);
    }

    /**
     * The presentation string used by the PDF.
     *
     * @param mixed $row
     */
    public function display($row): string
    {
        $value = $this->raw($row);

        if ($this->type === self::TYPE_BOOLEAN) {
            return $value ? $this->booleanLabels[0] : $this->booleanLabels[1];
        }

        if ($value === null || $value === '') {
            return $this->placeholder;
        }

        switch ($this->type) {
            case self::TYPE_NUMBER:
                return number_format((float) $value);

            case self::TYPE_DECIMAL:
                return number_format((float) $value, 2);

            case self::TYPE_CURRENCY:
                return ReportFormatter::currency((float) $value);

            case self::TYPE_DATE:
                return ReportFormatter::date($value);

            case self::TYPE_DATETIME:
                return ReportFormatter::dateTime($value);

            case self::TYPE_STATUS:
                $status = $this->statusFor($value);

                return $status[0];
        }

        return (string) $value;
    }

    /**
     * Tone name for status columns, used to pick the pill colours.
     *
     * @param mixed $row
     */
    public function tone($row): string
    {
        if ($this->type !== self::TYPE_STATUS) {
            return 'neutral';
        }

        $status = $this->statusFor($this->raw($row));

        return $status[1];
    }

    /**
     * The value Excel should store. Numbers stay numeric and dates become date
     * serials so the spreadsheet remains sortable and summable.
     *
     * @param mixed $row
     * @return mixed
     */
    public function excelValue($row)
    {
        $value = $this->raw($row);

        if ($this->type === self::TYPE_BOOLEAN) {
            return $value ? $this->booleanLabels[0] : $this->booleanLabels[1];
        }

        if ($value === null || $value === '') {
            return $this->placeholder;
        }

        if ($this->isNumeric()) {
            return (float) $value;
        }

        if ($this->isTemporal()) {
            $date = self::toDate($value);

            return $date ? ExcelDate::PHPToExcel($date) : $this->placeholder;
        }

        return $this->display($row);
    }

    /** Excel number format code for this column's cells. */
    public function excelFormat(): string
    {
        switch ($this->type) {
            case self::TYPE_NUMBER:
                return '#,##0';

            case self::TYPE_DECIMAL:
                return '#,##0.00';

            case self::TYPE_CURRENCY:
                return ReportFormatter::currencyExcelFormat();

            case self::TYPE_DATE:
                return 'yyyy-mm-dd';

            case self::TYPE_DATETIME:
                return 'yyyy-mm-dd hh:mm';
        }

        return NumberFormat::FORMAT_GENERAL;
    }

    /**
     * @param mixed $value
     * @return array{0: string, 1: string}
     */
    protected function statusFor($value): array
    {
        $key = is_bool($value) ? ($value ? '1' : '0') : (string) $value;

        if (isset($this->statuses[$key])) {
            return $this->statuses[$key];
        }

        return [$key === '' ? $this->placeholder : $key, 'neutral'];
    }

    /** Sum of this column across the given rows, or null when not totalled. */
    public function total(iterable $rows)
    {
        if (!$this->totalled) {
            return null;
        }

        $sum = 0.0;
        foreach ($rows as $row) {
            $sum += (float) $this->raw($row);
        }

        return $sum;
    }

    /** Formatted total for the PDF totals row. */
    public function displayTotal(iterable $rows): string
    {
        $total = $this->total($rows);

        if ($total === null) {
            return '';
        }

        if ($this->type === self::TYPE_CURRENCY) {
            return ReportFormatter::currency($total);
        }

        if ($this->type === self::TYPE_DECIMAL) {
            return number_format($total, 2);
        }

        return number_format($total);
    }

    /**
     * Normalises a Carbon/DateTime/string into a Carbon instance, or null.
     *
     * @param mixed $value
     */
    public static function toDate($value)
    {
        if ($value instanceof DateTimeInterface) {
            return Carbon::instance($value);
        }

        if ($value === null || $value === '') {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}
