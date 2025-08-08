@extends('user.layouts.app')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #f3f1f5 0%, #ffffff 100%);
        min-height: 100vh;
    }
    .profile-card {
        box-shadow: 0 4px 32px rgba(80, 112, 185, 0.14), 0 1.5px 4px rgba(80, 112, 185, 0.10);
        border-radius: 18px;
        border: none;
        background: #fff;
    }
    .profile-card .card-header {
        background: linear-gradient(90deg, #2575fc 0%, #8c5bc0 100%);
        color: #fff;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        font-size: 1.4rem;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .profile-card .form-label {
        font-weight: 500;
    }
    .profile-card .form-control {
        border-radius: 10px;
        min-height: 45px;
        font-size: 1rem;
    }
    .profile-card .btn-primary {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: bold;
        transition: background 0.3s;
    }
    .profile-card .btn-primary:hover {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
    }
    .profile-card .mt-3 {
        font-size: 1rem;
    }
    .profile-avatar {
        box-shadow: 0 2px 10px rgba(80,112,185,0.12);
        border: 3px solid #f3f1f5;
    }
</style>
@endsection
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-7 col-lg-5">
        <div class="card profile-card mt-4">
            <div class="card-header text-center">حسابي</div>
            <div class="card-body p-4">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 text-center">
                        <img src="{{ $user->profile_image }}" class="rounded-circle mb-2 profile-avatar" width="100" height="100">
                        <div>
                            <input type="file" name="profile_image" class="form-control mt-2" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
