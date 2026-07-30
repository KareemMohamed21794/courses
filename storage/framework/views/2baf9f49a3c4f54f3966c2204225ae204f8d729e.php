<div class="header-eyebrow"><?php echo e($eyebrow); ?></div>
<div class="header-title"><?php echo e($report->getTitle()); ?></div>
<div class="header-stamp">
    <?php if($rtl): ?>
        <span class="ltr"><?php echo e($generatedAt); ?></span> <?php echo e($generatedLabel); ?>:
    <?php else: ?>
        <?php echo e($generatedLabel); ?>: <span class="ltr"><?php echo e($generatedAt); ?></span>
    <?php endif; ?>
</div>
<?php /**PATH E:\xampp\htdocs\courses\resources\views/reports/pdf/partials/header-meta.blade.php ENDPATH**/ ?>