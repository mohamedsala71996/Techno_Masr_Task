@extends('user.layouts.app')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #f3f1f5 0%, #ffffff 100%);
        min-height: 100vh;
    }
    .login-card {
        box-shadow: 0 4px 32px rgba(80, 112, 185, 0.14), 0 1.5px 4px rgba(80, 112, 185, 0.10);
        border-radius: 18px;
        border: none;
        background: #fff;
    }
    .login-card .card-header {
        background: linear-gradient(90deg, #2575fc 0%, #8c5bc0 100%);
        color: #fff;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        font-size: 1.4rem;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .login-card .form-label {
        font-weight: 500;
    }
    .login-card .form-control {
        border-radius: 10px;
        min-height: 45px;
        font-size: 1rem;
    }
    .login-card .btn-primary {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: bold;
        transition: background 0.3s;
    }
    .login-card .btn-primary:hover {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
    }
    .login-card .mt-3 {
        font-size: 1rem;
    }
</style>
@endsection
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-7 col-lg-4">
        @include('user.layouts.partials.validation-errors')
        <div class="card login-card mt-4">
            <div class="card-header text-center">تسجيل الدخول</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="example@email.com">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="********">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">دخول</button>
                </form>
                <div class="mt-3 text-center">
                    <span>ليس لديك حساب؟</span> <a href="{{ route('register') }}" class="fw-bold" style="color:#2575fc;">تسجيل جديد</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
