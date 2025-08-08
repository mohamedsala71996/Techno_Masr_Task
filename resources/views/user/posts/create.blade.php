@extends('user.layouts.app')

@section('styles')
    <style>
        body {
            background: linear-gradient(135deg, #f3f1f5 0%, #ffffff 100%);
            min-height: 100vh;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(80, 112, 185, 0.1);
            border: 1px solid #e6e7f4;
        }
        
        .card-header {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            font-weight: bold;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 1.2rem;
        }
        
        .form-label {
            color: #4c249f;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e6e7f4;
            padding: 0.75rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.15);
        }
        
        .btn-success {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            border: none;
            border-radius: 8px;
            font-weight: bold;
            padding: 0.75rem 2rem;
            transition: all 0.2s ease;
        }
        
        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 117, 252, 0.3);
        }
    </style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mt-4">
            <div class="card-header">إضافة منشور جديد</div>
            <div class="card-body">
                <form action="{{ route('user.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">القسم</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">اختر القسم</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">المحتوى</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="main_image" class="form-label">صورة رئيسية</label>
                        <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">إرسال للمراجعة</button>
                </form>
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