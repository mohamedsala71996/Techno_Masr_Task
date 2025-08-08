<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPostsWithCategoryAndAuthor()
    {
        return $this->postRepository->allWithCategoryAndAuthor();
    }

    public function filterPostsWithCategoryAndAuthor($filters = [])
    {
        return $this->postRepository->filterWithCategoryAndAuthor($filters);
    }

    public function findPost($id)
    {
        return $this->postRepository->find($id);
    }

    /**
     * Get a post with category, author, comments, and commenters (users).
     */
    public function findPostWithCommenters($id)
    {
        return $this->postRepository->findWithCommenters($id);
    }

    public function createPost($data)
    {
        return $this->postRepository->create($data);
    }

    public function updatePost($id, $data)
    {
        return $this->postRepository->update($id, $data);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }

    public function approvePost($id)
    {
        return $this->postRepository->approve($id);
    }

    public function rejectPost($id)
    {
        return $this->postRepository->reject($id);
    }
}
