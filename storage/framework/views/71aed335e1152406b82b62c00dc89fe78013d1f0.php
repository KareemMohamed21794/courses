<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title><?php echo e($title); ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1a1a1a; }
        h1 { font-size: 18px; margin-bottom: 8px; }
        .meta { margin-bottom: 16px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: right; }
        th { background: #f3f4f6; }
        .ltr { direction: ltr; text-align: left; }
    </style>
</head>
<body>
    <h1><?php echo e($title); ?></h1>
    <div class="meta">
        <div>تاريخ التصدير: <?php echo e(now()->format('Y-m-d H:i')); ?></div>
        <div>عدد السجلات: <?php echo e($payments->count()); ?></div>
        <?php if(!empty($filters['search'])): ?>
            <div>بحث: <?php echo e($filters['search']); ?></div>
        <?php endif; ?>
        <?php if(!empty($filters['status']) && $filters['status'] !== 'all'): ?>
            <?php
                $statusLabels = ['pending' => 'قيد المراجعة', 'approved' => 'موافق عليه', 'rejected' => 'مرفوض'];
            ?>
            <div>الحالة: <?php echo e($statusLabels[$filters['status']] ?? $filters['status']); ?></div>
        <?php endif; ?>
        <?php if(!empty($filters['course_id']) && $filters['course_id'] !== 'all'): ?>
            <div>الكورس: <?php echo e($courses[$filters['course_id']] ?? $filters['course_id']); ?></div>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>الكورس</th>
                <th>رقم الهاتف</th>
                <th>الاسم</th>
                <th>الحالة</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($payment->id); ?></td>
                    <td><?php echo e(optional($payment->course)->title ?? '-'); ?></td>
                    <td class="ltr"><?php echo e($payment->phone_number); ?></td>
                    <td><?php echo e($payment->name ?? '-'); ?></td>
                    <td><?php echo e($payment->status_label); ?></td>
                    <td><?php echo e($payment->created_at->format('Y-m-d H:i')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6">لا توجد نتائج</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH E:\xampp\htdocs\courses\resources\views/auth/admin/payments/export-pdf.blade.php ENDPATH**/ ?>