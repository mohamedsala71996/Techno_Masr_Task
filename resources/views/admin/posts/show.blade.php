@extends('admin.layouts.app')

@section('title', 'تفاصيل المقال')

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>تفاصيل المقال</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>العنوان:</strong> {{ $post->title }}
                        </div>
                        <div class="mb-3">
                            <strong>التصنيف:</strong> {{ $post->category->name ?? '-' }}
                        </div>
                        <div class="mb-3">
                            <strong>الحالة:</strong>
                            @if($post->status == 'approved')
                                <span class="badge bg-success">معتمد</span>
                            @elseif($post->status == 'pending')
                                <span class="badge bg-warning">بانتظار المراجعة</span>
                            @else
                                <span class="badge bg-danger">مرفوض</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <strong>الكاتب:</strong> {{ $post->author->name ?? '-' }}
                        </div>
                        <div class="mb-3">
                            <strong>الوصف:</strong> {!! $post->description !!}
                        </div>
                        <div class="mb-3">
                            <strong>المعلقون:</strong>
                            @if($commenters->isEmpty())
                                <div>لا يوجد تعليقات بعد.</div>
                            @else
                                <ul>
                                    @foreach($commenters as $user)
                                        <li>{{ $user->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">عودة للقائمة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
