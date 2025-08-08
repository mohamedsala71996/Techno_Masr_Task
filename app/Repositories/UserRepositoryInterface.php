<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function allWithPostCount();
    public function find($id);
    public function update($id, array $data);
    public function ban($id);
    public function unban($id);
    public function create(array $data);
    public function filterWithPostCount($filters = []);
}
