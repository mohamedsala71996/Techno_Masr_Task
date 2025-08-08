@extends('admin.layouts.app')
@section('title', 'إدارة الأدوار')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>إدارة الأدوار والصلاحيات</h5>
                        @can('create roles')
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> إضافة دور جديد
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @include('admin.layouts.partials.validation-errors')
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الدور</th>
                                    <th>الصلاحيات</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach($role->permissions as $perm)
                                                <span class="badge bg-info">{{ __("permissions." . $perm->name) }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('edit roles')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                                            @endcan
                                            @can('delete roles')
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">لا توجد بيانات لعرضها</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.layouts.partials.delete')
@endsection
    
