<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function allWithCategoryAndAuthor()
    {
        return Post::with(['category', 'author'])->get();
    }

    public function filterWithCategoryAndAuthor($filters = [])
    {
        $query = Post::query()->with(['category', 'author']);
        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }
        if (!empty($filters['author'])) {
            $query->whereHas('author', function($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['author'] . '%');
            });
        }
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
        return $query->paginate(15);
    }

    public function find($id)
    {
        return Post::with(['category', 'author'])->findOrFail($id);
    }

    /**
     * Get a post with category, author, comments, and commenters (users).
     */
    public function findWithCommenters($id)
    {
        return Post::with(['category', 'author', 'comments.user'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
        return true;
    }

    public function approve($id)
    {
        $post = $this->find($id);
        $post->status = 'approved';
        $post->save();
        return $post;
    }

    public function reject($id)
    {
        $post = $this->find($id);
        $post->status = 'rejected';
        $post->save();
        return $post;
    }
}
