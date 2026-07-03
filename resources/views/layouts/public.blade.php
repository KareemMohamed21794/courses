<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'منصة الكورسات')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f4f6fb;
            color: #1a1a2e;
        }
        .navbar-brand { font-weight: 700; }
        .course-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,.08);
            transition: transform .2s;
        }
        .course-card:hover { transform: translateY(-4px); }
        .course-thumb {
            height: 200px;
            object-fit: cover;
            width: 100%;
            background: #e9ecef;
        }
        .btn-primary {
            background: #4361ee;
            border-color: #4361ee;
        }
        .btn-primary:hover {
            background: #3a56d4;
            border-color: #3a56d4;
        }
        .hero {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: #fff;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 24px 24px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" href="{{ route('courses.index') }}">منصة الكورسات</a>
        </div>
    </nav>

    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="text-center py-4 text-muted">
        <small>&copy; {{ date('Y') }} منصة الكورسات - جميع الحقوق محفوظة</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
