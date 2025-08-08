@extends('admin.layouts.app')
@section('title', 'إضافة دور جديد')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>إضافة دور جديد</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.layouts.partials.validation-errors')
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                           
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم الدور</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الصلاحيات</label>
                                <div class="row">
                                    @foreach($permissions as $perm)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}">
                                                <label class="form-check-label" for="perm_{{ $perm->id }}">{{ __("permissions." . $perm->name) }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">إلغاء</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
