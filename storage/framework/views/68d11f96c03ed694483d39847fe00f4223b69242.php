<table class="grid">
    <tr>
        <?php if($rtl): ?>
            <td class="end">
                <div class="brand-name"><?php echo e($company); ?></div>
                <?php if($tagline): ?><div class="brand-tagline"><?php echo e($tagline); ?></div><?php endif; ?>
            </td>
            <?php if($logo): ?>
                <td class="end" width="60"><img src="<?php echo e($logo); ?>" class="brand-logo" alt=""></td>
            <?php endif; ?>
        <?php else: ?>
            <?php if($logo): ?>
                <td class="start" width="60"><img src="<?php echo e($logo); ?>" class="brand-logo" alt=""></td>
            <?php endif; ?>
            <td class="start">
                <div class="brand-name"><?php echo e($company); ?></div>
                <?php if($tagline): ?><div class="brand-tagline"><?php echo e($tagline); ?></div><?php endif; ?>
            </td>
        <?php endif; ?>
    </tr>
</table>
<?php /**PATH E:\xampp\htdocs\courses\resources\views/reports/pdf/partials/header-brand.blade.php ENDPATH**/ ?>