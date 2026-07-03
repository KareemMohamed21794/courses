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
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="meta">
        <div>تاريخ التصدير: {{ now()->format('Y-m-d H:i') }}</div>
        <div>عدد السجلات: {{ $courses->count() }}</div>
        @if(!empty($filters['search']))
            <div>بحث: {{ $filters['search'] }}</div>
        @endif
        @if(!empty($filters['status']) && $filters['status'] !== 'all')
            <div>الحالة: {{ $filters['status'] === 'active' ? 'نشط' : 'غير نشط' }}</div>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>الحالة</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->is_active ? 'نشط' : 'غير نشط' }}</td>
                    <td>{{ $course->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">لا توجد نتائج</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
