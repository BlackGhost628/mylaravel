<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodEase')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Vazirmatn', 'Tahoma', sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        .auth-container {
            max-width: 420px;
            width: 100%;
            background: white;
            padding: 35px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 25px;
        }
        .auth-logo img {
            max-width: 80px;
            border-radius: 50%;
        }
        .auth-logo h2 {
            margin-top: 10px;
            color: #FF385C;
            font-weight: 700;
            font-size: 24px;
        }
        .auth-logo p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-right: 4px solid #28a745;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-right: 4px solid #dc3545;
        }
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-right: 4px solid #17a2b8;
        }
        .auth-form .form-group {
            margin-bottom: 18px;
        }
        .auth-form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }
        .auth-form .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
            background: #fafafa;
        }
        .auth-form .form-control:focus {
            border-color: #FF385C;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255,56,92,0.15);
            background: white;
        }
        .auth-form .form-control.is-invalid {
            border-color: #dc3545;
        }
        .auth-form .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
        .auth-form .btn-primary {
            width: 100%;
            padding: 13px;
            background: #FF385C;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .auth-form .btn-primary:hover {
            background: #e62e4f;
            transform: translateY(-2px);
        }
        .auth-form .btn-primary:active {
            transform: translateY(0);
        }
        .auth-form .auth-links {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #6b7280;
        }
        .auth-form .auth-links a {
            color: #FF385C;
            text-decoration: none;
            font-weight: 600;
        }
        .auth-form .auth-links a:hover {
            text-decoration: underline;
        }
        .auth-form .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }
        .auth-form .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #FF385C;
            cursor: pointer;
        }
        .auth-form .checkbox-group label {
            margin: 0;
            cursor: pointer;
            font-weight: normal;
        }
        @media (max-width: 480px) {
            .auth-container {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        {{-- لوگو --}}
        <div class="auth-logo">
            <img src="{{ asset('image/logo.png') }}" alt="FoodEase">
            <h2>FoodEase</h2>
            <p>سفارش آنلاین غذا</p>
        </div>

        {{-- پیام‌های موفقیت --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- پیام‌های خطا --}}
        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- پیام‌های اطلاع‌رسانی --}}
        @if(session('status'))
            <div class="alert-info">
                {{ session('status') }}
            </div>
        @endif

        {{-- خطاهای اعتبارسنجی --}}
        @if($errors->any())
            <div class="alert-error">
                <ul style="list-style:none;padding:0;margin:0;text-align:right;">
                    @foreach($errors->all() as $error)
                        <li>❌ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- محتوای صفحه --}}
        @yield('content')
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>