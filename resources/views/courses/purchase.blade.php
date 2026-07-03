@extends('layouts.public')

@section('title', 'شراء ' . $course->title)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <a href="{{ route('courses.index') }}" class="text-decoration-none text-muted small">&larr; العودة للكورسات</a>
                    <h2 class="fw-bold mt-2 mb-1">شراء الكورس</h2>
                    <p class="text-primary fw-semibold">{{ $course->title }}</p>
                    <hr>

                    <form action="{{ route('courses.purchase.store', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf

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
                            <label class="form-label">صورة إثبات التحويل / الدفع <span class="text-danger">*</span></label>
                            <input type="file" name="payment_image" class="form-control @error('payment_image') is-invalid @enderror"
                                   accept="image/*" required>
                            @error('payment_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">الحد الأقصى 5 ميجابايت - صيغ: JPG, PNG, WEBP</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">إرسال طلب الشراء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
