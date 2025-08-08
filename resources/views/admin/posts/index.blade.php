@extends('admin.layouts.app')

@section('title', 'قائمة المقالات')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>قائمة المقالات</h5>
                            @can('create posts')
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> إضافة مقال جديد
                                </a>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('admin.layouts.partials.validation-errors')
                            <form method="GET" action="{{ route('admin.posts.index') }}"
                                class="mb-3 row g-2 align-items-end">
                                <div class="col-md-2">
                                    <label>العنوان</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $filters['title'] ?? '' }}" placeholder="بحث بالعنوان">
                                </div>
                                <div class="col-md-2">
                                    <label>الكاتب</label>
                                    <input type="text" name="author" class="form-control"
                                        value="{{ $filters['author'] ?? '' }}" placeholder="بحث باسم الكاتب">
                                </div>
                                <div class="col-md-2">
                                    <label>التصنيف</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">الكل</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (($filters['category_id'] ?? '') == $category->id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>الحالة</label>
                                    <select name="status" class="form-control">
                                        <option value="">الكل</option>
                                        <option value="pending" @if (($filters['status'] ?? '') === 'pending') selected @endif>قيد
                                            الانتظار</option>
                                        <option value="approved" @if (($filters['status'] ?? '') === 'approved') selected @endif>معتمد
                                        </option>
                                        <option value="rejected" @if (($filters['status'] ?? '') === 'rejected') selected @endif>مرفوض
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
                                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                                </div>
                            </form>
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>العنوان</th>
                                        <th>التصنيف</th>
                                        <th>اعتماد/رفض</th>
                                        <th>الكاتب</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>
                                                <img src="{{ $post->main_image }}" width="40" height="40"
                                                    class="rounded-circle" alt="profile" />
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>
                                                @if ($post->category)
                                                    @php
                                                        $cat = $post->category;
                                                        $names = [];
                                                        while ($cat) {
                                                            array_unshift($names, $cat->name);
                                                            $cat = $cat->parent;
                                                        }
                                                    @endphp
                                                    {{ implode(' / ', $names) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>

                                                @if ($post->status == 'pending')
                                                    @can('approve posts')
                                                        <form action="{{ route('admin.posts.approve', $post->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success">اعتماد</button>
                                                        </form>
                                                        <form action="{{ route('admin.posts.reject', $post->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning">رفض</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @if ($post->status == 'approved')
                                                        <span class="badge bg-success">معتمد</span>
                                                    @elseif($post->status == 'rejected')
                                                        <span class="badge bg-danger">مرفوض</span>
                                                    @endif
                                                @endif

                                            </td>
                                            <td>{{ $post->author->name ?? '-' }}</td>
                                            <td>
                                                @can('show posts')
                                                    <a href="{{ route('admin.posts.show', $post->id) }}"
                                                        class="btn btn-sm btn-info">تفاصيل</a>
                                                @endcan
                                                @can('edit posts')
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                        class="btn btn-sm btn-primary">تعديل</a>
                                                @endcan
                                                @can('delete posts')
                                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                                        class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger delete-btn">حذف</button>
                                                    </form>
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
                                {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
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

