@extends('user.layouts.app')

@section('styles')
    <style>
        body {
            background: linear-gradient(135deg, #f3f1f5 0%, #ffffff 100%);
            min-height: 100vh;
        }
        .posts-list-card {
            position: relative;
            box-shadow: 0 6px 28px rgba(80,112,185,0.13), 0 2px 8px rgba(80,112,185,0.08);
            border-radius: 20px;
            border: 1.5px solid #e6e7f4;
            background: #fff;
            margin-bottom: 2.2rem;
            overflow: hidden;
            transition: box-shadow 0.23s, transform 0.18s;
            display: flex;
            flex-direction: column;
        }
        .posts-list-card:hover {
            box-shadow: 0 12px 40px rgba(80,112,185,0.19), 0 4px 16px rgba(80,112,185,0.13);
            transform: translateY(-3px) scale(1.012);
        }
        .posts-list-card .gradient-bar {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 7px;
            background: linear-gradient(180deg, #6a11cb 0%, #2575fc 100%);
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        .posts-list-card .card-body {
            padding: 1.5rem 1.5rem 1rem 1.5rem;
        }
        .posts-list-card .card-title a {
            color: #4c249f;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.35rem;
            letter-spacing: 0.5px;
            transition: color 0.2s;
        }
        .posts-list-card .card-title a:hover {
            color: #2575fc;
            text-decoration: underline;
        }
        .posts-list-card .category-label {
            display: inline-block;
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            font-size: 0.98rem;
            font-weight: 500;
            border-radius: 7px;
            padding: 3px 13px 3px 13px;
            margin-bottom: 0.7rem;
            margin-right: 2px;
            box-shadow: 0 2px 8px rgba(80,112,185,0.09);
            letter-spacing: 0.2px;
        }
        .posts-list-card .card-text {
            font-size: 1.04rem;
            color: #444b5a;
        }
        .posts-list-card .card-meta {
            color: #7b7f8c;
            font-size: 0.97rem;
            margin-bottom: 0.4rem;
        }
        .posts-list-card .btn-outline-primary {
            border-radius: 10px;
            font-weight: bold;
            border-width: 2px;
            transition: background 0.2s, color 0.2s;
            padding: 7px 22px;
            font-size: 1.01rem;
        }
        .posts-list-card .btn-outline-primary:hover {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            border-color: #2575fc;
        }
        .posts-list-card .img-fluid {
            border-radius: 18px 0 0 18px;
            object-fit: cover;
            height: 100%;
            min-height: 170px;
            max-height: 210px;
            box-shadow: 0 2px 8px rgba(80,112,185,0.07);
        }
        @media (max-width: 991px) {
            .posts-list-card .img-fluid {
                border-radius: 18px 18px 0 0;
                max-height: 180px;
            }
        }
        @media (max-width: 767px) {
            .posts-list-card {
                flex-direction: column;
            }
            .posts-list-card .img-fluid {
                border-radius: 18px 18px 0 0;
                width: 100%;
                min-height: 120px;
                max-height: 180px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2 class="mb-4 text-center">المنشورات</h2>
            @foreach ($posts as $post)
    <div class="posts-list-card mb-3">
        <div class="gradient-bar"></div>
        <div class="row g-0 align-items-stretch">
            @if ($post->main_image)
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="{{ $post->main_image }}" class="img-fluid" alt="صورة المنشور">
                </div>
            @endif
            <div class="col-md-8">
                <div class="card-body">
                    @if ($post->category)
                        @php
                            $cat = $post->category;
                            $names = [];
                            while ($cat) {
                                array_unshift($names, $cat->name);
                                $cat = $cat->parent;
                            }
                        @endphp
                        <span class="category-label mb-2">{{ implode(' / ', $names) }}</span>
                    @endif
                    <h5 class="card-title mt-2 mb-2">
                        <a href="{{ route('user.posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h5>
                    <div class="card-meta mb-2">
                        بواسطة <span>{{ $post->author->name }}</span> | {{ $post->created_at->diffForHumans() }}
                    </div>
                    <p class="card-text mb-3">{{ \Str::limit(strip_tags($post->description), 120) }}</p>
                    <a href="{{ route('user.posts.show', $post->slug) }}" class="btn btn-outline-primary btn-sm">عرض التفاصيل</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
            <div class="d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
