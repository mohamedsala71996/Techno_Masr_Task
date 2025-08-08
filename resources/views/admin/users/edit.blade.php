@extends('admin.layouts.app')

@section('title', 'تعديل مستخدم')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>تعديل بيانات المستخدم</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.layouts.partials.validation-errors')
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}" >
                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">صورة البروفايل (اختياري)</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                                <img src="{{ $user->profile_image }}" width="60" height="60" class="rounded-circle mt-2" alt="profile" />
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">إلغاء</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
