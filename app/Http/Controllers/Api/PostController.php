<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponse;

    public function approved(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $perPage = min($perPage, 50); // Limit max per page to 50

        $posts = Post::where('status', 'approved')
            ->with(['author:id,name', 'category:id,name'])
            ->withCount('comments')
            ->orderByDesc('created_at')
            ->paginate($perPage);

            return $this->paginatedResponse(
                PostResource::collection($posts),
                'تم جلب المنشورات بنجاح'
            );
    }
}
