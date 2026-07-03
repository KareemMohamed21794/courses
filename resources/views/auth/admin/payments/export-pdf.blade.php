<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1a1a1a; }
        h1 { font-size: 18px; margin-bottom: 8px; }
        .meta { margin-bottom: 16px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: right; }
        th { background: #f3f4f6; }
        .ltr { direction: ltr; text-align: left; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="meta">
        <div>تاريخ التصدير: {{ now()->format('Y-m-d H:i') }}</div>
        <div>عدد السجلات: {{ $payments->count() }}</div>
        @if(!empty($filters['search']))
            <div>بحث: {{ $filters['search'] }}</div>
        @endif
        @if(!empty($filters['status']) && $filters['status'] !== 'all')
            @php
                $statusLabels = ['pending' => 'قيد المراجعة', 'approved' => 'موافق عليه', 'rejected' => 'مرفوض'];
            @endphp
            <div>الحالة: {{ $statusLabels[$filters['status']] ?? $filters['status'] }}</div>
        @endif
        @if(!empty($filters['course_id']) && $filters['course_id'] !== 'all')
            <div>الكورس: {{ $courses[$filters['course_id']] ?? $filters['course_id'] }}</div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>الكورس</th>
                <th>رقم الهاتف</th>
                <th>الاسم</th>
                <th>الحالة</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ optional($payment->course)->title ?? '-' }}</td>
                    <td class="ltr">{{ $payment->phone_number }}</td>
                    <td>{{ $payment->name ?? '-' }}</td>
                    <td>{{ $payment->status_label }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">لا توجد نتائج</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
