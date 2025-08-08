<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsersWithPostCount()
    {
        return $this->userRepository->allWithPostCount();
    }

    public function filterUsersWithPostCount($filters = [])
    {
        return $this->userRepository->filterWithPostCount($filters);
    }

    public function findUser($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser($data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function banUser($id)
    {
        return $this->userRepository->ban($id);
    }

    public function unbanUser($id)
    {
        return $this->userRepository->unban($id);
    }


}
