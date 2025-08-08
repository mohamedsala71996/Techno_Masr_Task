@extends('user.layouts.app')

@section('styles')
    <style>
        body {
            background: linear-gradient(135deg, #f3f1f5 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .post-detail-card {
            position: relative;
            box-shadow: 0 6px 28px rgba(80, 112, 185, 0.13), 0 2px 8px rgba(80, 112, 185, 0.08);
            border-radius: 20px;
            border: 1.5px solid #e6e7f4;
            background: #fff;
            margin-bottom: 2.2rem;
            overflow: hidden;
            transition: box-shadow 0.23s, transform 0.18s;
        }

        .post-detail-card:hover {
            box-shadow: 0 12px 40px rgba(80, 112, 185, 0.19), 0 4px 16px rgba(80, 112, 185, 0.13);
            transform: translateY(-2px);
        }

        .post-detail-card .gradient-bar {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 7px;
            background: linear-gradient(180deg, #6a11cb 0%, #2575fc 100%);
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .post-detail-card .card-body {
            padding: 2rem 2rem 1.5rem 2rem;
        }

        .post-detail-card .card-title {
            color: #4c249f;
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .post-detail-card .card-meta {
            color: #7b7f8c;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e6e7f4;
        }

        .post-detail-card .card-meta span {
            color: #2575fc;
            font-weight: 600;
        }

        .post-detail-card .card-text {
            font-size: 1.1rem;
            color: #444b5a;
            line-height: 1.7;
        }

        .post-detail-card .card-img-top {
            border-radius: 20px 20px 0 0;
            object-fit: cover;
            max-height: 400px;
            width: 100%;
        }

        .post-detail-card .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 1px solid #ffc107;
            border-radius: 12px;
            color: #856404;
            font-weight: 500;
        }

        /* Comments Section */
        .comments-card {
            position: relative;
            box-shadow: 0 6px 28px rgba(80, 112, 185, 0.13), 0 2px 8px rgba(80, 112, 185, 0.08);
            border-radius: 20px;
            border: 1.5px solid #e6e7f4;
            background: #fff;
            margin-bottom: 2.2rem;
            overflow: hidden;
        }

        .comments-card .card-header {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            border: none;
            padding: 1.2rem 2rem;
            border-radius: 20px 20px 0 0;
        }

        .comments-card .card-body {
            padding: 2rem;
        }

        .comments-card .form-control {
            border-radius: 12px;
            border: 2px solid #e6e7f4;
            padding: 1rem;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .comments-card .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.25);
        }

        .comments-card .btn-primary {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            border: none;
            border-radius: 12px;
            font-weight: bold;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .comments-card .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 117, 252, 0.3);
        }

        .comments-card .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            border: 1px solid #17a2b8;
            border-radius: 12px;
            color: #0c5460;
            font-weight: 500;
        }

        .comment-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            border-left: 4px solid #2575fc;
        }

        .comment-item:last-child {
            margin-bottom: 0;
        }

        .comment-author {
            color: #4c249f;
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .comment-time {
            color: #7b7f8c;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .comment-content {
            color: #444b5a;
            font-size: 1rem;
            line-height: 1.6;
        }

        .no-comments {
            text-align: center;
            color: #7b7f8c;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .post-detail-card .card-body {
                padding: 1.5rem 1.5rem 1rem 1.5rem;
            }

            .post-detail-card .card-title {
                font-size: 1.5rem;
            }

            .comments-card .card-body {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Post Detail Card -->
            <div class="post-detail-card">
                <div class="gradient-bar"></div>
                @if ($post->main_image)
                    <img src="{{ $post->main_image }}" class="card-img-top" alt="صورة المنشور">
                @endif
                <div class="card-body">
                    <h3 class="card-title">{{ $post->title }}</h3>
                    <div class="card-meta">
                        بواسطة <span>{{ $post->author->name }}</span> | {{ $post->created_at->format('Y-m-d H:i') }}
                    </div>
                    <div class="card-text">{!! $post->description !!}</div>
                    @if ($post->status === 'pending')
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-clock me-2"></i>
                            هذا المنشور في انتظار موافقة الإدارة.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-card">
                <div class="card-header">
                    <i class="fas fa-comments me-2"></i>
                    التعليقات
                </div>
                <div class="card-body">
                    @forelse($post->comments as $comment)
                        <div class="comment-item">
                            <div class="comment-author">{{ $comment->user->name }}</div>
                            <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                            <div class="comment-content">{{ $comment->content }}</div>
                        </div>
                    @empty
                        <div class="no-comments">
                            <i class="fas fa-comment-slash fa-2x mb-3"></i>
                            <div>لا توجد تعليقات بعد.</div>
                        </div>
                    @endforelse
                    <hr class="my-4">

                    @auth
                        <form action="{{ route('user.comments.store', $post->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="4" placeholder="اكتب تعليقك..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                إرسال
                            </button>
                        </form>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            يجب تسجيل الدخول للتعليق.
                        </div>
                    @endauth



                </div>
            </div>
        </div>
    </div>
@endsection
