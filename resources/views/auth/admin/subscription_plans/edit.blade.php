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
                <form action="{{ route('admin.subscription-plans.update', $plan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label class="form-label required">اسم الخطة</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">الكورس (اتركه فارغاً لخطة عامة)</label>
                        <select name="course_id" class="form-select">
                            <option value="">عام — كل الكورسات</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id', $plan->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="form-label required">المدة</label>
                        <select name="duration_in_months" class="form-select" required>
                            <option value="3" {{ old('duration_in_months', $plan->duration_in_months) == 3 ? 'selected' : '' }}>ربع سنوي (3 أشهر)</option>
                            <option value="6" {{ old('duration_in_months', $plan->duration_in_months) == 6 ? 'selected' : '' }}>نصف سنوي (6 أشهر)</option>
                            <option value="12" {{ old('duration_in_months', $plan->duration_in_months) == 12 ? 'selected' : '' }}>سنوي (12 شهر)</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="form-label required">السعر</label>
                        <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $plan->price) }}" required>
                    </div>
                    <div class="mb-5 form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ $plan->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">نشط</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                        <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
