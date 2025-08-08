@extends('admin.layouts.app')

@section('title', 'تعديل مشرف')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>تعديل بيانات المشرف</h5>
                        </div>
                        <div class="card-body">
                            @include('admin.layouts.partials.validation-errors')
                            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="id" value="{{ $admin->id }}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $admin->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email', $admin->email) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">الأدوار</label>
                                    <select name="role" id="role"
                                        class="form-control @error('role') is-invalid @enderror" required>
                                        <option value="">اختر دورًا</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ old('role', $adminRoles[0] ?? '') == $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">إلغاء</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
