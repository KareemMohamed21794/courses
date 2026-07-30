
<!DOCTYPE html>
<html lang="<?php echo e($rtl ? 'ar' : 'en'); ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo e($report->getTitle()); ?></title>
    <style>
        @page  { margin: 126px 34px 84px 34px; }

        body {
            margin: 0;
            padding: 0;
            font-family: "<?php echo e($font); ?>", sans-serif;
            font-size: 9.5pt;
            line-height: 1.5;
            color: <?php echo e($theme['text']); ?>;
            background: <?php echo e($theme['page_bg']); ?>;
        }

        .start  { text-align: <?php echo e($rtl ? 'right' : 'left'); ?>; }
        .end    { text-align: <?php echo e($rtl ? 'left' : 'right'); ?>; }
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
        .brand-name { font-size: 15pt; font-weight: bold; color: <?php echo e($theme['primary']); ?>; line-height: 1.2; }
        .brand-tagline { font-size: 8pt; color: <?php echo e($theme['muted']); ?>; }

        
        .header-eyebrow { font-size: 7.5pt; color: <?php echo e($theme['muted']); ?>; }
        .header-title { font-size: 11pt; font-weight: bold; color: <?php echo e($theme['primary']); ?>; }
        .header-stamp { font-size: 8pt; color: <?php echo e($theme['muted']); ?>; }

        .rule { margin-top: 9px; height: 3px; background: <?php echo e($theme['primary']); ?>; font-size: 0; line-height: 0; }
        .rule-accent {
            height: 3px;
            width: 92px;
            background: <?php echo e($theme['accent']); ?>;
            font-size: 0;
            line-height: 0;
            margin-<?php echo e($rtl ? 'left' : 'right'); ?>: auto;
            margin-<?php echo e($rtl ? 'right' : 'left'); ?>: 0;
        }

        /* ------------------------------ running footer */

        .sheet-footer {
            position: fixed;
            bottom: -64px;
            left: 0;
            right: 0;
            height: 54px;
            border-top: 1px solid <?php echo e($theme['border']); ?>;
            padding-top: 6px;
            font-size: 7.5pt;
            color: <?php echo e($theme['muted']); ?>;
        }

        

        /* ------------------------------ title block */

        .report-title { font-size: 19pt; font-weight: bold; color: <?php echo e($theme['primary']); ?>; margin: 0; line-height: 1.25; }
        .report-subtitle { font-size: 9.5pt; color: <?php echo e($theme['muted']); ?>; margin: 3px 0 0 0; }
        .title-underline {
            margin-top: 9px;
            height: 2px;
            width: 128px;
            background: <?php echo e($theme['accent']); ?>;
            font-size: 0;
            line-height: 0;
            margin-<?php echo e($rtl ? 'left' : 'right'); ?>: auto;
            margin-<?php echo e($rtl ? 'right' : 'left'); ?>: 0;
        }

        /* ------------------------------ applied filters */

        .chips { margin-top: 13px; }
        .chip {
            display: inline-block;
            background: <?php echo e($theme['primary_soft']); ?>;
            border: 1px solid <?php echo e($theme['border']); ?>;
            border-radius: 3px;
            padding: 3px 9px;
            margin-bottom: 4px;
            font-size: 8pt;
            color: <?php echo e($theme['primary']); ?>;
        }
        .chip-label { color: <?php echo e($theme['muted']); ?>; }

        /* ------------------------------ summary strip */

        .summary { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .summary td {
            background: <?php echo e($theme['primary_soft']); ?>;
            border: 1px solid <?php echo e($theme['border']); ?>;
            padding: 8px 11px;
            vertical-align: top;
        }
        .summary-value { font-size: 13.5pt; font-weight: bold; color: <?php echo e($theme['primary']); ?>; line-height: 1.25; }
        .summary-label { font-size: 7.5pt; color: <?php echo e($theme['muted']); ?>; }

        /* ------------------------------ data table */

        .data { width: 100%; border-collapse: collapse; margin-top: 17px; }
        .data th {
            background: <?php echo e($theme['header_bg']); ?>;
            color: <?php echo e($theme['header_text']); ?>;
            font-size: 8.5pt;
            font-weight: bold;
            padding: 8px 7px;
            border: 1px solid <?php echo e($theme['header_bg']); ?>;
        }
        .data td {
            padding: 6px 7px;
            border: 1px solid <?php echo e($theme['border']); ?>;
            font-size: 8.5pt;
            word-wrap: break-word;
        }
        .data tr { page-break-inside: avoid; }
        .data tr.odd td { background: <?php echo e($theme['zebra']); ?>; }
        .data tfoot td {
            background: <?php echo e($theme['total_bg']); ?>;
            font-weight: bold;
            color: <?php echo e($theme['primary']); ?>;
        }

        .pill { display: inline-block; border-radius: 8px; padding: 2px 8px; font-size: 7.5pt; font-weight: bold; }
<?php $__currentLoopData = $tones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tone => $colors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        .pill-<?php echo e($tone); ?> { background: <?php echo e($colors['bg']); ?>; color: <?php echo e($colors['text']); ?>; }
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        .empty-state {
            margin-top: 17px;
            border: 1px dashed <?php echo e($theme['border']); ?>;
            background: <?php echo e($theme['zebra']); ?>;
            padding: 26px;
            text-align: center;
            color: <?php echo e($theme['muted']); ?>;
        }

        .note {
            margin-top: 14px;
            font-size: 8pt;
            color: <?php echo e($theme['muted']); ?>;
            border-<?php echo e($rtl ? 'right' : 'left'); ?>: 3px solid <?php echo e($theme['accent']); ?>;
            padding: 2px 9px;
        }
    </style>
</head>
<body>

<div class="sheet-header">
    <table class="grid">
        <tr>
            <?php if($rtl): ?>
                <td class="start" width="42%"><?php echo $__env->make('reports.pdf.partials.header-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                <td class="end" width="58%"><?php echo $__env->make('reports.pdf.partials.header-brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
            <?php else: ?>
                <td class="start" width="58%"><?php echo $__env->make('reports.pdf.partials.header-brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                <td class="end" width="42%"><?php echo $__env->make('reports.pdf.partials.header-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
            <?php endif; ?>
        </tr>
    </table>
    <div class="rule"></div>
    <div class="rule-accent"></div>
</div>

<div class="sheet-footer">
    
    <div class="start" style="padding-<?php echo e($rtl ? 'left' : 'right'); ?>: 96px;"><?php echo e($footerLine); ?></div>
</div>

<div class="start">
    <h1 class="report-title"><?php echo e($report->getTitle()); ?></h1>
    <?php if($report->getSubtitle()): ?>
        <p class="report-subtitle"><?php echo e($report->getSubtitle()); ?></p>
    <?php endif; ?>
    <div class="title-underline"></div>
</div>

<?php if(count($filters)): ?>
    
    <div class="chips start">
        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($rtl): ?>
                <span class="chip"><?php echo e($value); ?> <span class="chip-label"><?php echo e($label); ?>:</span></span>
            <?php else: ?>
                <span class="chip"><span class="chip-label"><?php echo e($label); ?>:</span> <?php echo e($value); ?></span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php if(count($summary)): ?>
    <table class="summary">
        <tr>
            <?php $__currentLoopData = $summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="start" width="<?php echo e($summaryWidth); ?>%">
                    <div class="summary-value start ltr"><?php echo e($value); ?></div>
                    <div class="summary-label"><?php echo e($label); ?></div>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </table>
<?php endif; ?>

<?php if(count($rows)): ?>
    <table class="data">
        <colgroup>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <col <?php if($column['width']): ?> style="width: <?php echo e($column['width']); ?>%" <?php endif; ?>>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </colgroup>
        <thead>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="<?php echo e($column['align']); ?>"><?php echo e($column['label']); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cells): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="<?php echo e($index % 2 ? 'odd' : 'even'); ?>">
                    <?php $__currentLoopData = $cells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="<?php echo e($cell['align']); ?><?php echo e($cell['ltr'] ? ' ltr' : ''); ?>"><?php if($cell['tone']): ?><span class="pill pill-<?php echo e($cell['tone']); ?>"><?php echo e($cell['text']); ?></span><?php else: ?><?php echo e($cell['text']); ?><?php endif; ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <?php if(count($totals)): ?>
            <tfoot>
                <tr>
                    <?php $__currentLoopData = $totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="<?php echo e($total['align']); ?><?php echo e($total['ltr'] ? ' ltr' : ''); ?>"><?php echo e($total['text']); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
<?php else: ?>
    <div class="empty-state"><?php echo e($report->getEmptyMessage()); ?></div>
<?php endif; ?>

<?php if($report->getNote()): ?>
    <div class="note start"><?php echo e($report->getNote()); ?></div>
<?php endif; ?>

</body>
</html>
<?php /**PATH E:\xampp\htdocs\courses\resources\views/reports/pdf/document.blade.php ENDPATH**/ ?>