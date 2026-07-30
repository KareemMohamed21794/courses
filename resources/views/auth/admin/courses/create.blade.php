@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title fw-bold">{{ $title }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label class="form-label required">عنوان الكورس</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-5">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label class="form-label">المدرّب / المدرب</label>
                            <input type="text" name="instructor" class="form-control" value="{{ old('instructor') }}">
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="form-label">سعر الشراء لمرة واحدة</label>
                            <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') }}" placeholder="0.00">
                            <div class="form-text">يظهر للمستخدم عند اختيار شراء الكورس بدون اشتراك.</div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">صورة توضيحية</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">صور إضافية (اختياري)</label>
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">رابط فيديو تعريفي (YouTube / Vimeo / رابط مباشر)</label>
                        <input type="url" name="intro_video_url" class="form-control" value="{{ old('intro_video_url') }}" placeholder="https://...">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">أو رفع فيديو تعريفي</label>
                        <input type="file" name="intro_video_file" class="form-control" accept="video/mp4,video/webm,video/quicktime,.mp4,.webm,.mov">
                        <div class="form-text">يمكنك إدخال رابط أو رفع ملف (ليس الاثنين معاً — الأولوية للملف).</div>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف PDF</label>
                        <input type="file" name="pdf_file" class="form-control @error('pdf_file') is-invalid @enderror" accept=".pdf">
                        @error('pdf_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">ارفع ملف PDF أو فيديو المحتوى (أحدهما على الأقل مطلوب).</div>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف فيديو المحتوى</label>
                        <input type="file" name="video_file" class="form-control @error('video_file') is-invalid @enderror" accept="video/mp4,video/webm,video/quicktime,video/x-msvideo,.mp4,.webm,.mov,.avi">
                        @error('video_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">الصيغ المدعومة: MP4, WebM, MOV, AVI (حتى 500 ميجابايت).</div>
                    </div>
                    <div class="mb-5 form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked>
                        <label class="form-check-label" for="is_active">نشط</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
