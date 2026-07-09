
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title fw-bold"><?php echo e($title); ?>: <?php echo e($course->title); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.courses.update', $course)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="mb-5">
                        <label class="form-label required">عنوان الكورس</label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $course->title)); ?>" required>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo e(old('description', $course->description)); ?></textarea>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">صورة توضيحية</label>
                        <?php if($course->thumbnail): ?>
                            <div class="mb-2"><img src="<?php echo e($course->thumbnail_url); ?>" width="120" style="border-radius:8px;"></div>
                        <?php endif; ?>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف PDF (اتركه فارغاً للإبقاء على الملف الحالي)</label>
                        <?php if($course->pdf_file): ?>
                            <div class="mb-2 text-muted small">الملف الحالي: <?php echo e($course->pdf_file); ?></div>
                        <?php endif; ?>
                        <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف فيديو (اتركه فارغاً للإبقاء على الملف الحالي)</label>
                        <?php if($course->video_file): ?>
                            <div class="mb-2 text-muted small">الملف الحالي: <?php echo e($course->video_file); ?></div>
                        <?php endif; ?>
                        <input type="file" name="video_file" class="form-control <?php $__errorArgs = ['video_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="video/mp4,video/webm,video/quicktime,video/x-msvideo,.mp4,.webm,.mov,.avi">
                        <?php $__errorArgs = ['video_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-text">الصيغ المدعومة: MP4, WebM, MOV, AVI (حتى 500 ميجابايت).</div>
                    </div>
                    <div class="mb-5 form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" <?php echo e($course->is_active ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="is_active">نشط</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.admin.include.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\courses\resources\views/auth/admin/courses/edit.blade.php ENDPATH**/ ?>