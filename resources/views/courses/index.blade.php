@extends('layouts.public')

@section('title', 'الكورسات المتاحة')

@section('content')
<div class="hero text-center">
    <div class="container">
        <h1 class="fw-bold mb-2">الكورسات المتاحة</h1>
        <p class="mb-0 opacity-75">تصفح التفاصيل، اختر خطة اشتراك، وحمّل المحتوى بعد الموافقة</p>
    </div>
</div>

<div class="container pb-5">
    @if($courses->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted fs-5">لا توجد كورسات متاحة حالياً.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($courses as $course)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card course-card h-100">
                        <img src="{{ $course->thumbnail_url }}" class="course-thumb" alt="{{ $course->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $course->title }}</h5>
                            @if($course->instructor)
                                <div class="small text-muted mb-2">المدرب: {{ $course->instructor }}</div>
                            @endif
                            @if($course->price !== null)
                                <div class="fw-semibold text-primary mb-2">شراء لمرة واحدة: {{ number_format((float)$course->price, 2) }}</div>
                            @endif
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($course->description, 120) }}</p>
                            <div class="d-grid gap-2 mt-2">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">عرض التفاصيل</a>
                                <button type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#downloadModal"
                                        data-course-id="{{ $course->id }}"
                                        data-course-title="{{ $course->title }}"
                                        data-verify-url="{{ route('courses.verify', $course) }}"
                                        data-purchase-url="{{ route('courses.subscribe', $course) }}">
                                    تحميل الكورس
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@include('courses.partials.verify-modal')
@endsection

@push('scripts')
@include('courses.partials.verify-script')
@endpush
