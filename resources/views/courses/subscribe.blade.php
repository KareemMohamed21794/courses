@extends('layouts.public')

@section('title', 'اشتراك في ' . $course->title)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <a href="{{ route('courses.show', $course) }}" class="text-decoration-none text-muted small">&larr; العودة لتفاصيل الكورس</a>
                    <h2 class="fw-bold mt-2 mb-1">طلب اشتراك</h2>
                    <p class="text-primary fw-semibold">{{ $course->title }}</p>
                    <hr>

                    <form action="{{ route('courses.subscribe.store', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">خطة الاشتراك <span class="text-danger">*</span></label>
                            @foreach($plans as $plan)
                                <div class="form-check border rounded-3 p-3 mb-2">
                                    <input class="form-check-input ms-2" type="radio" name="subscription_plan_id"
                                           id="plan_{{ $plan->id }}" value="{{ $plan->id }}"
                                           {{ (string) old('subscription_plan_id') === (string) $plan->id ? 'checked' : ($loop->first ? 'checked' : '') }} required>
                                    <label class="form-check-label w-100" for="plan_{{ $plan->id }}">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-semibold">{{ $plan->name }}</span>
                                            <span class="text-primary fw-bold">{{ number_format((float)$plan->price, 2) }}</span>
                                        </div>
                                        <small class="text-muted">{{ $plan->duration_label }}</small>
                                    </label>
                                </div>
                            @endforeach
                            @error('subscription_plan_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                            <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                                   value="{{ old('phone_number') }}" placeholder="9627xxxxxxxx" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الاسم (اختياري)</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="اسمك">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">صورة إثبات التحويل / الدفع (اختياري)</label>
                            <input type="file" name="payment_image" class="form-control @error('payment_image') is-invalid @enderror"
                                   accept="image/*">
                            @error('payment_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">الحد الأقصى 5 ميجابايت - صيغ: JPG, PNG, WEBP</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">إرسال طلب الاشتراك</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
