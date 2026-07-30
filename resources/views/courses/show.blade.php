@extends('layouts.public')

@section('title', $course->title)

@section('content')
<div class="container py-4">
    <a href="{{ route('courses.index') }}" class="text-decoration-none text-muted small">&larr; العودة للكورسات</a>

    <div class="row g-4 mt-1">
        <div class="col-lg-7">
            <img src="{{ $course->thumbnail_url }}" class="w-100 rounded-4 mb-3" style="max-height:360px;object-fit:cover;" alt="{{ $course->title }}">

            @if($course->hasIntroVideo())
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">فيديو تعريفي</h5>
                    @if($course->intro_video_type === 'file')
                        <video controls class="w-100 rounded-3" style="max-height:400px;background:#000;">
                            <source src="{{ $course->intro_video_embed_url }}" type="video/mp4">
                        </video>
                    @else
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                            <iframe src="{{ $course->intro_video_embed_url }}" title="Intro video" allowfullscreen></iframe>
                        </div>
                    @endif
                </div>
            @endif

            @if(!empty($course->gallery_image_urls))
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">معرض الصور</h5>
                    <div class="row g-2">
                        @foreach($course->gallery_image_urls as $url)
                            <div class="col-4 col-md-3">
                                <img src="{{ $url }}" class="w-100 rounded-3" style="height:90px;object-fit:cover;" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-3">{{ $course->title }}</h1>
                    @if($course->instructor)
                        <p class="mb-2"><span class="text-muted">المدرب:</span> <strong>{{ $course->instructor }}</strong></p>
                    @endif
                    <div class="text-secondary" style="white-space:pre-line;">{{ $course->description }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top:1rem;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">خيارات الشراء والاشتراك</h5>

                    <div class="border rounded-3 p-3 mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">شراء لمرة واحدة</div>
                            <small class="text-muted">وصول دائم بعد الموافقة</small>
                        </div>
                        @if($course->price !== null)
                            <span class="fw-bold text-primary">{{ number_format((float)$course->price, 2) }}</span>
                        @else
                            <span class="text-muted small">السعر غير محدد</span>
                        @endif
                    </div>
                    <a href="{{ route('courses.purchase', $course) }}" class="btn btn-outline-primary w-100 mb-3">شراء لمرة واحدة</a>

                    @if($plans->isEmpty())
                        <p class="text-muted mb-0">لا توجد خطط اشتراك متاحة حالياً.</p>
                    @else
                        <div class="list-group mb-3">
                            @foreach($plans as $plan)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $plan->name }}</div>
                                        <small class="text-muted">{{ $plan->duration_label }}</small>
                                    </div>
                                    <span class="fw-bold text-primary">{{ number_format((float)$plan->price, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('courses.subscribe', $course) }}" class="btn btn-primary w-100 mb-2">اشترك الآن</a>
                    @endif

                    <button type="button"
                            class="btn btn-success w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#downloadModal"
                            data-course-id="{{ $course->id }}"
                            data-course-title="{{ $course->title }}"
                            data-verify-url="{{ route('courses.verify', $course) }}"
                            data-purchase-url="{{ route('courses.subscribe', $course) }}">
                        تحميل المحتوى (للمشتركين)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('courses.partials.verify-modal')
@endsection

@push('scripts')
@include('courses.partials.verify-script')
@endpush
