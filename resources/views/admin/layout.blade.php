<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت - FoodEase</title>
    
    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --admin-primary: #FF385C;
            --admin-secondary: #2D2D2D;
            --admin-bg: #f8f9fa;
        }

        * {
            font-family: 'Vazirmatn', sans-serif;
        }

        body {
            background: var(--admin-bg);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== Sidebar ===== */
        .admin-sidebar {
            width: 280px;
            background: var(--admin-secondary);
            color: white;
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }

        .admin-sidebar .brand {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .admin-sidebar .brand img {
            max-width: 80px;
            border-radius: 50%;
        }

        .admin-sidebar .brand h3 {
            margin-top: 10px;
            color: white;
            font-weight: 700;
        }

        .admin-sidebar .brand small {
            color: rgba(255,255,255,0.6);
            font-size: 12px;
        }

        .admin-sidebar .nav-menu {
            padding: 20px 0;
        }

        .admin-sidebar .nav-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-right: 3px solid transparent;
        }

        .admin-sidebar .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .admin-sidebar .nav-item.active {
            background: rgba(255,56,92,0.15);
            color: var(--admin-primary);
            border-right-color: var(--admin-primary);
        }

        .admin-sidebar .nav-item i {
            width: 24px;
            font-size: 18px;
        }

        .admin-sidebar .nav-item .badge {
            margin-right: auto;
            background: var(--admin-primary);
        }

        /* ===== Main Content ===== */
        .admin-content {
            margin-right: 280px;
            flex: 1;
            padding: 30px;
        }

        /* ===== Top Bar ===== */
        .admin-topbar {
            background: white;
            padding: 15px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .admin-topbar h4 {
            margin: 0;
            color: var(--admin-secondary);
        }

        .admin-topbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-topbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* ===== Stats Cards ===== */
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            border-right: 4px solid var(--admin-primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-card .icon.primary {
            background: rgba(255,56,92,0.1);
            color: var(--admin-primary);
        }
        .stat-card .icon.success {
            background: rgba(40,167,69,0.1);
            color: #28a745;
        }
        .stat-card .icon.warning {
            background: rgba(255,193,7,0.1);
            color: #ffc107;
        }
        .stat-card .icon.info {
            background: rgba(23,162,184,0.1);
            color: #17a2b8;
        }

        .stat-card h3 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .stat-card .label {
            color: #6c757d;
            font-size: 14px;
        }

        /* ===== Tables ===== */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table-container .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-container .table-header h5 {
            margin: 0;
        }

        .btn-admin-primary {
            background: var(--admin-primary);
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s;
        }

        .btn-admin-primary:hover {
            background: #e62e4f;
            color: white;
            transform: translateY(-2px);
        }

        .table-admin {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table-admin thead th {
            background: #f8f9fa;
            padding: 12px 15px;
            font-weight: 600;
            color: #495057;
            border: none;
        }

        .table-admin tbody tr {
            background: white;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }

        .table-admin tbody tr:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .table-admin tbody td {
            padding: 12px 15px;
            border: none;
            vertical-align: middle;
        }

        .table-admin .avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .btn-action {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 13px;
            border: none;
            transition: all 0.3s;
        }

        .btn-action.edit {
            background: #0d6efd;
            color: white;
        }

        .btn-action.edit:hover {
            background: #0b5ed7;
        }

        .btn-action.delete {
            background: #dc3545;
            color: white;
        }

        .btn-action.delete:hover {
            background: #bb2d3b;
        }

        .btn-action.view {
            background: #17a2b8;
            color: white;
        }

        .btn-action.view:hover {
            background: #138496;
        }

        /* ===== Forms ===== */
        .form-admin {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-admin .form-group {
            margin-bottom: 20px;
        }

        .form-admin label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-admin .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }

        .form-admin .form-control:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(255,56,92,0.1);
        }

        .form-admin .form-control.is-invalid {
            border-color: #dc3545;
        }

        /* ===== Responsive ===== */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--admin-secondary);
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-content {
                margin-right: 0;
                padding: 15px;
            }

            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="brand">
            <img src="{{ asset('image/logo.png') }}" alt="FoodEase">
            <h3>پنل مدیریت</h3>
            <small>FoodEase Restaurant</small>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item @if(Route::is('admin.dashboard')) active @endif">
                <i class="fas fa-chart-pie"></i>
                <span>داشبورد</span>
            </a>
            <a href="{{ route('admin.products') }}" class="nav-item @if(Route::is('admin.products*')) active @endif">
                <i class="fas fa-utensils"></i>
                <span>مدیریت محصولات</span>
                <span class="badge">{{ \App\Models\Product::count() }}</span>
            </a>
            <a href="{{ route('admin.contacts') }}" class="nav-item @if(Route::is('admin.contacts*')) active @endif">
                <i class="fas fa-envelope"></i>
                <span>پیام‌ها</span>
                <span class="badge">{{ \App\Models\Contact::where('is_read', false)->count() }}</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item @if(Route::is('admin.orders*')) active @endif">
                <i class="fas fa-shopping-bag"></i>
                <span>سفارش‌ها</span>
                <span class="badge">0</span>
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item @if(Route::is('admin.users*')) active @endif">
                <i class="fas fa-users"></i>
                <span>کاربران</span>
            </a>

            <a href="{{ route('admin.articles.index') }}" class="nav-item @if(Route::is('admin.articles*')) active @endif">
    <i class="fas fa-newspaper"></i>
    <span>مقالات</span>
    @php
        try {
            $pendingCount = \App\Models\Article::pending()->count();
        } catch (\Exception $e) {
            $pendingCount = 0;
        }
    @endphp
    @if($pendingCount > 0)
        <span class="badge" style="background:#17a2b8;">{{ $pendingCount }}</span>
    @endif
</a>

<a href="{{ route('admin.comments.index') }}" class="nav-item @if(Route::is('admin.comments*')) active @endif">
    <i class="fas fa-comments"></i>
    <span>نظرات</span>
    @php
        $pendingCount = \App\Models\Comment::where('is_approved', false)->count();
    @endphp
    @if($pendingCount > 0)
        <span class="badge" style="background:#ffc107;color:#000;">{{ $pendingCount }}</span>
    @endif
</a>

       
            <hr style="border-color:rgba(255,255,255,0.1);margin:15px 0;">
            <a href="{{ route('home') }}" class="nav-item">
                <i class="fas fa-globe"></i>
                <span>مشاهده سایت</span>
            </a>
            <!-- دکمه خروج موقتاً مخفی شد تا سیستم احراز هویت نصب شود -->
            {{-- 
            <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>خروج</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
            --}}
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
        <!-- Top Bar -->
        <div class="admin-topbar">
            <div>
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h4>@yield('title')</h4>
            </div>
            <div class="user-info">
                <span>مدیر</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=FF385C&color=fff&size=40" alt="User">
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>