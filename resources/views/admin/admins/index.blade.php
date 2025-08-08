@extends('admin.layouts.app')

@section('title', 'إدارة المشرفين')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>قائمة المشرفين</h5>
                            @can('create admins')
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> إضافة مشرف جديد
                                </a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.admins.index') }}"
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
                                    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                                </div>
                            </form>
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>عدد المنشورات</th>
                                        <th>الدور</th>
                                        <th>الحالة</th>
                                        <th>إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->posts_count }}</td>
                                            <td>
                                                @if($admin->roles)
                                                    <span class="badge bg-info">{{ $admin->roles->first()->name }}</span>
                                                @else
                                                    <span class="text-muted">بدون دور</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($admin->is_banned)
                                                    <span class="badge bg-danger">محظور</span>
                                                @else
                                                    <span class="badge bg-success">نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('edit admins')
                                                    <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                                        class="btn btn-sm btn-primary">تعديل</a>
                                                @endcan
                                                @can('ban admins')
                                                    @if ($admin->is_banned)
                                                        <form action="{{ route('admin.admins.unban', $admin->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">فك
                                                                الحظر</button>
                                                        </form>
                                                    @elseif($admin->id != $firstAdmin->id)
                                                        <form action="{{ route('admin.admins.ban', $admin->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger">حظر</button>
                                                        </form>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">لا توجد بيانات لعرضها</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $admins->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
