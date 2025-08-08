<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Admin;
use App\Services\PostService;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageHandler;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    use ImageHandler;
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('permission:view posts')->only('index');
        $this->middleware('permission:create posts')->only('create', 'store');
        $this->middleware('permission:edit posts')->only('edit', 'update');
        $this->middleware('permission:delete posts')->only('destroy');
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'title', 'author', 'category_id', 'status', 'date_from', 'date_to'
        ]);
        $categories = Category::all();
        $posts = $this->postService->filterPostsWithCategoryAndAuthor($filters);
        return view('admin.posts.index', compact('posts', 'filters', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $post = $this->postService->createPost($request->validated() + [
            'author_id' => Auth::guard('admin')->id(),
            'author_type' => Admin::class
        ]);
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('post_images', 'public');
            $this->updateMorphImage($post, $path, 'main_image');
        }
        return redirect()->route('admin.posts.index')->with('success', 'تم إضافة المقال بنجاح');
    }

    public function edit($id)
    {
        $post = $this->postService->findPost($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->postService->updatePost($id, $request->validated());
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('post_images', 'public');
            $this->updateMorphImage($post, $path, 'main_image');
        }
        return redirect()->route('admin.posts.index')->with('success', 'تم تحديث المقال');
    }

    public function destroy($id)
    {
        $post = $this->postService->findPost($id);
        $this->deleteMorphImage($post, 'main_image');
        $this->postService->deletePost($id);
        return redirect()->route('admin.posts.index')->with('success', 'تم حذف المقال');
    }

    public function approve($id)
    {
        $this->postService->approvePost($id);
        return redirect()->route('admin.posts.index')->with('success', 'تمت الموافقة على المقال');
    }

    public function reject($id)
    {
        $this->postService->rejectPost($id);
        return redirect()->route('admin.posts.index')->with('success', 'تم رفض المقال');
    }

    public function show($id)
    {
        $post = $this->postService->findPostWithCommenters($id);
        $commenters = $post->comments
            ->pluck('user')
            ->filter()
            ->unique('id')
            ->values();
        return view('admin.posts.show', compact('post', 'commenters'));
    }
}
