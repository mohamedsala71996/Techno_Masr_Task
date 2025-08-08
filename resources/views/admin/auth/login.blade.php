@extends('admin.layouts.auth')

@section('title', 'تسجيل دخول الأدمن')

@push('styles')
    <style>
        .login-wrapper {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-card {
            background: rgba(255,255,255,0.93);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 40px 30px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 10px 40px rgba(35, 53, 84, 0.18);
            animation: fadeInUp 0.6s ease-in-out;
            color: #23272f;
        }
        .login-card h3 {
            font-weight: 700;
            margin-bottom: 10px;
            color: #233554;
        }
        .form-control {
            background-color: #f5f6fa;
            border: 1px solid #cbd5e1;
            color: #23272f;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.18rem rgba(79, 70, 229, 0.22);
            border-color: #6366f1;
        }
        .btn-login {
            background: #2563eb;
            border: none;
            font-weight: bold;
            color: #fff;
            transition: 0.3s;
            box-shadow: 0 2px 10px rgba(37,99,235,0.10);
        }
        .btn-login:hover {
            background: #143797;
            color: #fff;
        }
        .logo-img {
            width: 75px;
            margin-bottom: 20px;
            animation: bounceInDown 1s ease both;
            background: #f5f6fa;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(35,53,84,0.08);
        }
        .footer-text {
            color: #7b809a;
            font-size: 13px;
            text-align: center;
            margin-top: 25px;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceInDown {
            0% { opacity: 0; transform: translateY(-200px); }
            60% { opacity: 1; transform: translateY(30px); }
            100% { transform: translateY(0); }
        }
    </style>
@endpush

@section('content')
    <div class="login-wrapper">
        @include('admin.auth._form')
    </div>
@endsection


