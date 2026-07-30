@extends('layouts.public')

@section('title', 'اشتراكاتي')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h2 class="fw-bold mb-3">لوحة الاشتراكات</h2>
                    <p class="text-muted">أدخل رقم هاتفك لعرض حالة الاشتراك والتاريخ المتبقي والسجل.</p>
                    <form method="GET" action="{{ route('subscriptions.dashboard') }}" class="row g-2">
                        <div class="col-md-8">
                            <input type="tel" name="phone_number" class="form-control" value="{{ $phone }}" placeholder="9627xxxxxxxx" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">عرض الاشتراكات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($phone)
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">الاشتراكات الحالية / قيد المراجعة</h5>
                        @forelse($active as $sub)
                            <div class="border rounded-3 p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <div class="fw-semibold">{{ optional($sub->course)->title }}</div>
                                        <small class="text-muted">{{ optional($sub->plan)->name }}</small>
                                    </div>
                                    <span class="badge
                                        @if($sub->status === 'approved') bg-success
                                        @elseif($sub->status === 'pending') bg-warning text-dark
                                        @else bg-secondary @endif">
                                        {{ $sub->status_label }}
                                    </span>
                                </div>
                                @if($sub->start_date)
                                    <div class="small">البداية: {{ $sub->start_date->format('Y-m-d') }}</div>
                                @endif
                                @if($sub->end_date)
                                    <div class="small">الانتهاء: {{ $sub->end_date->format('Y-m-d') }}</div>
                                @endif
                                @if($sub->remaining_days !== null)
                                    <div class="small fw-semibold text-primary">المتبقي: {{ $sub->remaining_days }} يوم</div>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted mb-0">لا توجد اشتراكات نشطة أو قيد المراجعة.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">سجل الاشتراكات</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>الكورس</th>
                                        <th>الحالة</th>
                                        <th>الفترة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($history as $sub)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">{{ optional($sub->course)->title }}</div>
                                                <small class="text-muted">{{ optional($sub->plan)->name }}</small>
                                            </td>
                                            <td>{{ $sub->status_label }}</td>
                                            <td class="small">
                                                @if($sub->start_date || $sub->end_date)
                                                    {{ optional($sub->start_date)->format('Y-m-d') ?? '-' }}
                                                    →
                                                    {{ optional($sub->end_date)->format('Y-m-d') ?? '-' }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-muted">لا يوجد سجل.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
