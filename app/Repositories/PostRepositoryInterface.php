<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function allWithCategoryAndAuthor();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function approve($id);
    public function reject($id);
    public function findWithCommenters($id);
    public function filterWithCategoryAndAuthor($filters = []);
}
