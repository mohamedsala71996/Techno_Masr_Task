<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, $postId)
    {
        Post::findOrFail($postId)->comments()->create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);
    
        return redirect()->back()->with('success', 'تم إضافة التعليق بنجاح.');
    }
}
