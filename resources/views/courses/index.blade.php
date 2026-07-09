@extends('layouts.public')

@section('title', 'الكورسات المتاحة')

@section('content')
<div class="hero text-center">
    <div class="container">
        <h1 class="fw-bold mb-2">الكورسات المتاحة</h1>
        <p class="mb-0 opacity-75">اختر الكورس المناسب وحمّل ملفات الكورس (PDF والفيديو) بعد التحقق أو الشراء</p>
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
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($course->description, 120) }}</p>
                            <button type="button"
                                    class="btn btn-primary w-100 mt-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#downloadModal"
                                    data-course-id="{{ $course->id }}"
                                    data-course-title="{{ $course->title }}"
                                    data-verify-url="{{ route('courses.verify', $course) }}"
                                    data-purchase-url="{{ route('courses.purchase', $course) }}">
                                تحميل الكورس
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="modal fade" id="downloadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalCourseTitle">تحميل الكورس</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#verifyTab" type="button">التحقق من الهاتف</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#purchaseTab" type="button">شراء الكورس</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="verifyTab">
                        <p class="text-muted small">أدخل رقم الهاتف المسجل لدينا للتحقق والتحميل.</p>
                        <div id="verifyAlert" class="alert d-none"></div>
                        <form id="verifyForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="tel" name="phone_number" class="form-control" placeholder="مثال: 9627xxxxxxxx" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" id="verifyBtn">تحقق وحمّل</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="purchaseTab">
                        <p class="text-muted">لم تشتري بعد؟ انتقل إلى صفحة الشراء لرفع إثبات الدفع.</p>
                        <a href="#" id="purchaseLink" class="btn btn-outline-primary w-100">الذهاب إلى صفحة الشراء</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('downloadModal');
    const verifyForm = document.getElementById('verifyForm');
    const verifyAlert = document.getElementById('verifyAlert');
    const verifyBtn = document.getElementById('verifyBtn');
    const purchaseLink = document.getElementById('purchaseLink');
    const modalTitle = document.getElementById('modalCourseTitle');
    let verifyUrl = '';

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        verifyUrl = button.getAttribute('data-verify-url');
        purchaseLink.href = button.getAttribute('data-purchase-url');
        modalTitle.textContent = 'تحميل: ' + button.getAttribute('data-course-title');
        verifyAlert.classList.add('d-none');
        verifyForm.reset();
    });

    verifyForm.addEventListener('submit', function (e) {
        e.preventDefault();
        verifyBtn.disabled = true;
        verifyBtn.textContent = 'جاري التحقق...';
        verifyAlert.classList.add('d-none');

        fetch(verifyUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                phone_number: verifyForm.phone_number.value
            })
        })
        .then(res => res.json().then(data => ({ ok: res.ok, data })))
        .then(({ ok, data }) => {
            verifyAlert.classList.remove('d-none');
            if (ok && data.success) {
                verifyAlert.className = 'alert alert-success';
                verifyAlert.textContent = data.message;
                window.location.href = data.download_url;
            } else {
                verifyAlert.className = 'alert alert-danger';
                verifyAlert.textContent = data.message || 'حدث خطأ، يرجى المحاولة مرة أخرى.';
            }
        })
        .catch(() => {
            verifyAlert.classList.remove('d-none');
            verifyAlert.className = 'alert alert-danger';
            verifyAlert.textContent = 'حدث خطأ في الاتصال.';
        })
        .finally(() => {
            verifyBtn.disabled = false;
            verifyBtn.textContent = 'تحقق وحمّل';
        });
    });
});
</script>
@endpush
