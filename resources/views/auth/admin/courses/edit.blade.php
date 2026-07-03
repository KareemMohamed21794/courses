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
                    <div class="mb-5">
                        <label class="form-label">صورة توضيحية</label>
                        @if($course->thumbnail)
                            <div class="mb-2"><img src="{{ $course->thumbnail_url }}" width="120" style="border-radius:8px;"></div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">ملف PDF (اتركه فارغاً للإبقاء على الملف الحالي)</label>
                        <input type="file" name="pdf_file" class="form-control" accept=".pdf">
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
