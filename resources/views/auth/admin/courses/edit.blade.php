@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title fw-bold">{{ $title }}: {{ $course->title }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label class="form-label required">عنوان الكورس</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label class="form-label">المدرّب / المدرب</label>
                            <input type="text" name="instructor" class="form-control" value="{{ old('instructor', $course->instructor) }}">
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="form-label">سعر الشراء لمرة واحدة</label>
                            <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $course->price) }}" placeholder="0.00">
                            <div class="form-text">يظهر للمستخدم عند اختيار شراء الكورس بدون اشتراك.</div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">صورة توضيحية</label>
                        @if($course->thumbnail)
                            <div class="mb-2"><img src="{{ $course->thumbnail_url }}" width="120" style="border-radius:8px;"></div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">صور إضافية</label>
                        @if(!empty($course->gallery_image_urls))
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @foreach($course->gallery_image_urls as $url)
                                    <img src="{{ $url }}" width="80" height="60" style="object-fit:cover;border-radius:6px;">
                                @endforeach
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" name="remove_gallery" value="1" class="form-check-input" id="remove_gallery">
                                <label class="form-check-label" for="remove_gallery">حذف كل الصور الإضافية</label>
                            </div>
                        @endif
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text">رفع صور جديدة يضيفها إلى المعرض الحالي.</div>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">رابط فيديو تعريفي</label>
                        @if($course->intro_video && $course->intro_video_type === 'url')
                            <div class="mb-2 text-muted small">الحالي: {{ $course->intro_video }}</div>
                        @endif
                        <input type="url" name="intro_video_url" class="form-control" value="{{ old('intro_video_url', $course->intro_video_type === 'url' ? $course->intro_video : '') }}" placeholder="https://...">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">رفع فيديو تعريفي جديد</label>
                        @if($course->intro_video && $course->intro_video_type === 'file')
                            <div class="mb-2 text-muted small">ملف حالي مرفوع</div>
                        @endif
                        <input type="file" name="intro_video_file" class="form-control" accept="video/mp4,video/webm,video/quicktime,.mp4,.webm,.mov">
                        @if($course->intro_video)
                            <div class="form-check mt-2">
                                <input type="checkbox" name="remove_intro_video" value="1" class="form-check-input" id="remove_intro_video">
                                <label class="form-check-label" for="remove_intro_video">حذف الفيديو التعريفي</label>
                            </div>
                        @endif
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف PDF (اتركه فارغاً للإبقاء على الملف الحالي)</label>
                        @if($course->pdf_file)
                            <div class="mb-2 text-muted small">الملف الحالي: {{ $course->pdf_file }}</div>
                        @endif
                        <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف فيديو المحتوى (اتركه فارغاً للإبقاء على الملف الحالي)</label>
                        @if($course->video_file)
                            <div class="mb-2 text-muted small">الملف الحالي: {{ $course->video_file }}</div>
                        @endif
                        <input type="file" name="video_file" class="form-control @error('video_file') is-invalid @enderror" accept="video/mp4,video/webm,video/quicktime,video/x-msvideo,.mp4,.webm,.mov,.avi">
                        @error('video_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-5 form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ $course->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">نشط</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
