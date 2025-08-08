@extends('admin.layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>قائمة المستخدمين</h5>
                            @can('create users')
                                <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> إضافة مستخدم جديد
                                </a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.users.index') }}"
                                class="mb-3 row g-2 align-items-end">
                                <div class="col-md-3">
                                    <label>البريد الإلكتروني</label>
                                    <input type="text" name="email" class="form-control"
                                        value="{{ $filters['email'] ?? '' }}" placeholder="بحث بالبريد">
                                </div>
                                <div class="col-md-2">
                                    <label>الحالة</label>
                                    <select name="status" class="form-control">
                                        <option value="">الكل</option>
                                        <option value="active" @if (($filters['status'] ?? '') === 'active') selected @endif>نشط
                                        </option>
                                        <option value="banned" @if (($filters['status'] ?? '') === 'banned') selected @endif>محظور
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>من تاريخ</label>
                                    <input type="date" name="date_from" class="form-control"
                                        value="{{ $filters['date_from'] ?? '' }}">
                                </div>
                                <div class="col-md-2">
                                    <label>إلى تاريخ</label>
                                    <input type="date" name="date_to" class="form-control"
                                        value="{{ $filters['date_to'] ?? '' }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">بحث</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('admin.users.export', request()->query()) }}" class="btn btn-success">
                                        <i class="fas fa-file-excel"></i> إكسل
                                    </a>
                                </div>
                            </form>
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>عدد المنشورات</th>
                                        <th>الحالة</th>
                                        <th>إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <img src="{{ $user->profile_image }}" width="40" height="40"
                                                    class="rounded-circle" alt="profile" />
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->posts_count }}</td>
                                            <td>
                                                @if ($user->is_banned)
                                                    <span class="badge bg-danger">محظور</span>
                                                @else
                                                    <span class="badge bg-success">نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('edit users')
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-primary">تعديل</a>
                                                @endcan
                                                @can('ban users')
                                                    @if ($user->is_banned)
                                                        <form action="{{ route('admin.users.unban', $user->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">فك
                                                                الحظر</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.users.ban', $user->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger">حظر</button>
                                                        </form>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">لا توجد بيانات لعرضها</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
