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
        <div>عدد السجلات: {{ $admins->count() }}</div>
        @if(!empty($filters['search']))
            <div>بحث: {{ $filters['search'] }}</div>
        @endif
        @if(!empty($filters['active']) && $filters['active'] !== 'All')
            <div>الحالة: {{ $filters['active'] }}</div>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم المستخدم</th>
                @if($segment === 'users')
                    <th>المجموعة</th>
                @endif
                <th>الاسم</th>
                <th>البريد</th>
                <th>الهاتف</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->username }}</td>
                    @if($segment === 'users')
                        <td>{{ $admin->group_name ?? '-' }}</td>
                    @endif
                    <td>{{ $admin->name }}</td>
                    <td class="ltr">{{ $admin->email }}</td>
                    <td class="ltr">{{ $admin->phone ?? '-' }}</td>
                    <td>{{ $admin->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $segment === 'users' ? 7 : 6 }}">لا توجد نتائج</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
