@extends('admin.layouts.app')
@section('title', 'إضافة مقال جديد')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>إضافة مقال جديد</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.layouts.partials.validation-errors')
                        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">العنوان</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea name="description" id="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">التصنيف</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">اختر التصنيف</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="main_image" class="form-label">الصورة الرئيسية</label>
                                <input type="file" name="main_image" id="main_image" class="form-control" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">إضافة المقال</button>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">إلغاء</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        language: 'ar',
        height: 250
    });
</script>
@endsection
