{{--
    Shared layout for every PDF report in the system.

    Content is laid out left-to-right on purpose: RTL strings are pre-shaped
    into visually ordered Arabic presentation forms by ArabicShaper before
    dompdf sees them, so letting dompdf apply direction would reverse them a
    second time. Mirroring is done instead through the alignment classes below
    and through the already-reversed column order in $columns.
--}}
<!DOCTYPE html>
<html lang="{{ $rtl ? 'ar' : 'en' }}">
<head>
    <meta charset="utf-8">
    <title>{{ $report->getTitle() }}</title>
    <style>
        @page { margin: 126px 34px 84px 34px; }

        body {
            margin: 0;
            padding: 0;
            font-family: "{{ $font }}", sans-serif;
            font-size: 9.5pt;
            line-height: 1.5;
            color: {{ $theme['text'] }};
            background: {{ $theme['page_bg'] }};
        }

        .start  { text-align: {{ $rtl ? 'right' : 'left' }}; }
        .end    { text-align: {{ $rtl ? 'left' : 'right' }}; }
        .center { text-align: center; }
        .ltr    { direction: ltr; }

        /* ------------------------------ running header */

        .sheet-header {
            position: fixed;
            top: -106px;
            left: 0;
            right: 0;
            height: 94px;
        }

        .grid { width: 100%; border-collapse: collapse; }
        .grid td { vertical-align: middle; padding: 0; border: 0; }

        .brand-logo { height: 44px; width: auto; }
        .brand-name { font-size: 15pt; font-weight: bold; color: {{ $theme['primary'] }}; line-height: 1.2; }
        .brand-tagline { font-size: 8pt; color: {{ $theme['muted'] }}; }

        {{-- No letter-spacing anywhere: it would pull apart the joined Arabic
             presentation forms and make words look broken. --}}
        .header-eyebrow { font-size: 7.5pt; color: {{ $theme['muted'] }}; }
        .header-title { font-size: 11pt; font-weight: bold; color: {{ $theme['primary'] }}; }
        .header-stamp { font-size: 8pt; color: {{ $theme['muted'] }}; }

        .rule { margin-top: 9px; height: 3px; background: {{ $theme['primary'] }}; font-size: 0; line-height: 0; }
        .rule-accent {
            height: 3px;
            width: 92px;
            background: {{ $theme['accent'] }};
            font-size: 0;
            line-height: 0;
            margin-{{ $rtl ? 'left' : 'right' }}: auto;
            margin-{{ $rtl ? 'right' : 'left' }}: 0;
        }

        /* ------------------------------ running footer */

        .sheet-footer {
            position: fixed;
            bottom: -64px;
            left: 0;
            right: 0;
            height: 54px;
            border-top: 1px solid {{ $theme['border'] }};
            padding-top: 6px;
            font-size: 7.5pt;
            color: {{ $theme['muted'] }};
        }

        {{-- The "page X of Y" stamp is drawn on the canvas after layout, since
             dompdf never increments the CSS "pages" counter. --}}

        /* ------------------------------ title block */

        .report-title { font-size: 19pt; font-weight: bold; color: {{ $theme['primary'] }}; margin: 0; line-height: 1.25; }
        .report-subtitle { font-size: 9.5pt; color: {{ $theme['muted'] }}; margin: 3px 0 0 0; }
        .title-underline {
            margin-top: 9px;
            height: 2px;
            width: 128px;
            background: {{ $theme['accent'] }};
            font-size: 0;
            line-height: 0;
            margin-{{ $rtl ? 'left' : 'right' }}: auto;
            margin-{{ $rtl ? 'right' : 'left' }}: 0;
        }

        /* ------------------------------ applied filters */

        .chips { margin-top: 13px; }
        .chip {
            display: inline-block;
            background: {{ $theme['primary_soft'] }};
            border: 1px solid {{ $theme['border'] }};
            border-radius: 3px;
            padding: 3px 9px;
            margin-bottom: 4px;
            font-size: 8pt;
            color: {{ $theme['primary'] }};
        }
        .chip-label { color: {{ $theme['muted'] }}; }

        /* ------------------------------ summary strip */

        .summary { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .summary td {
            background: {{ $theme['primary_soft'] }};
            border: 1px solid {{ $theme['border'] }};
            padding: 8px 11px;
            vertical-align: top;
        }
        .summary-value { font-size: 13.5pt; font-weight: bold; color: {{ $theme['primary'] }}; line-height: 1.25; }
        .summary-label { font-size: 7.5pt; color: {{ $theme['muted'] }}; }

        /* ------------------------------ data table */

        .data { width: 100%; border-collapse: collapse; margin-top: 17px; }
        .data th {
            background: {{ $theme['header_bg'] }};
            color: {{ $theme['header_text'] }};
            font-size: 8.5pt;
            font-weight: bold;
            padding: 8px 7px;
            border: 1px solid {{ $theme['header_bg'] }};
        }
        .data td {
            padding: 6px 7px;
            border: 1px solid {{ $theme['border'] }};
            font-size: 8.5pt;
            word-wrap: break-word;
        }
        .data tr { page-break-inside: avoid; }
        .data tr.odd td { background: {{ $theme['zebra'] }}; }
        .data tfoot td {
            background: {{ $theme['total_bg'] }};
            font-weight: bold;
            color: {{ $theme['primary'] }};
        }

        .pill { display: inline-block; border-radius: 8px; padding: 2px 8px; font-size: 7.5pt; font-weight: bold; }
@foreach($tones as $tone => $colors)
        .pill-{{ $tone }} { background: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; }
@endforeach

        .empty-state {
            margin-top: 17px;
            border: 1px dashed {{ $theme['border'] }};
            background: {{ $theme['zebra'] }};
            padding: 26px;
            text-align: center;
            color: {{ $theme['muted'] }};
        }

        .note {
            margin-top: 14px;
            font-size: 8pt;
            color: {{ $theme['muted'] }};
            border-{{ $rtl ? 'right' : 'left' }}: 3px solid {{ $theme['accent'] }};
            padding: 2px 9px;
        }
    </style>
</head>
<body>

<div class="sheet-header">
    <table class="grid">
        <tr>
            @if($rtl)
                <td class="start" width="42%">@include('reports.pdf.partials.header-meta')</td>
                <td class="end" width="58%">@include('reports.pdf.partials.header-brand')</td>
            @else
                <td class="start" width="58%">@include('reports.pdf.partials.header-brand')</td>
                <td class="end" width="42%">@include('reports.pdf.partials.header-meta')</td>
            @endif
        </tr>
    </table>
    <div class="rule"></div>
    <div class="rule-accent"></div>
</div>

<div class="sheet-footer">
    {{-- Space is reserved on the trailing edge for the canvas-drawn pager. --}}
    <div class="start" style="padding-{{ $rtl ? 'left' : 'right' }}: 96px;">{{ $footerLine }}</div>
</div>

<div class="start">
    <h1 class="report-title">{{ $report->getTitle() }}</h1>
    @if($report->getSubtitle())
        <p class="report-subtitle">{{ $report->getSubtitle() }}</p>
    @endif
    <div class="title-underline"></div>
</div>

@if(count($filters))
    {{-- Inline boxes always flow left-to-right here, so RTL order is mirrored
         by hand: the chips arrive pre-reversed and label/value are swapped. --}}
    <div class="chips start">
        @foreach($filters as $label => $value)
            @if($rtl)
                <span class="chip">{{ $value }} <span class="chip-label">{{ $label }}:</span></span>
            @else
                <span class="chip"><span class="chip-label">{{ $label }}:</span> {{ $value }}</span>
            @endif
        @endforeach
    </div>
@endif

@if(count($summary))
    <table class="summary">
        <tr>
            @foreach($summary as $label => $value)
                <td class="start" width="{{ $summaryWidth }}%">
                    <div class="summary-value start ltr">{{ $value }}</div>
                    <div class="summary-label">{{ $label }}</div>
                </td>
            @endforeach
        </tr>
    </table>
@endif

@if(count($rows))
    <table class="data">
        <colgroup>
            @foreach($columns as $column)
                <col @if($column['width']) style="width: {{ $column['width'] }}%" @endif>
            @endforeach
        </colgroup>
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th class="{{ $column['align'] }}">{{ $column['label'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $index => $cells)
                <tr class="{{ $index % 2 ? 'odd' : 'even' }}">
                    @foreach($cells as $cell)
                        <td class="{{ $cell['align'] }}{{ $cell['ltr'] ? ' ltr' : '' }}">@if($cell['tone'])<span class="pill pill-{{ $cell['tone'] }}">{{ $cell['text'] }}</span>@else{{ $cell['text'] }}@endif</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        @if(count($totals))
            <tfoot>
                <tr>
                    @foreach($totals as $total)
                        <td class="{{ $total['align'] }}{{ $total['ltr'] ? ' ltr' : '' }}">{{ $total['text'] }}</td>
                    @endforeach
                </tr>
            </tfoot>
        @endif
    </table>
@else
    <div class="empty-state">{{ $report->getEmptyMessage() }}</div>
@endif

@if($report->getNote())
    <div class="note start">{{ $report->getNote() }}</div>
@endif

</body>
</html>
