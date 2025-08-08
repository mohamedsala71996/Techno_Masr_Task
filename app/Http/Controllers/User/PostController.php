<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\User\StorePostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Traits\ImageHandler;
use App\Traits\PaginatesCollection;

class PostController extends Controller
{
    use ImageHandler , PaginatesCollection;

    public function index()
    {
        $topPostId = Cache::get('top_post_id');

        if ($topPostId) {
            $topPost = Post::where('status', 'approved')
                ->with(['author', 'category'])
                ->find($topPostId);
    
            $otherPosts = Post::where('status', 'approved')
                ->with(['author', 'category'])
                ->where('id', '!=', $topPostId)
                ->orderBy('created_at', 'desc')
                ->get();
    
            $posts = collect([$topPost])->merge($otherPosts);
            $posts = $this->paginateCollection($posts, 15);
        } else {
            $posts = Post::where('status', 'approved')->with(['author', 'category'])->latest()->paginate(15);
        }
        return view('user.home', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['author', 'comments.user'])->firstOrFail();
        return view('user.posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            ...$request->validated(),
            'author_id' => Auth::id(),
            'author_type' => User::class,
        ]);
    
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('main_images', 'public');
            $this->updateMorphImage($post, $path, 'main_image');
        }
    
        return redirect()->route('user.home')->with('success', 'تم إرسال المنشور للمراجعة بنجاح.');
    }
}
