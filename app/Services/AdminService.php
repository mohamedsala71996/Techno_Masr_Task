<?php

namespace App\Services;

use App\Repositories\AdminRepositoryInterface;

class AdminService
{
    protected $adminRepo;

    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function getAllAdminsWithPostCount()
    {
        return $this->adminRepo->allWithPostCount();
    }

    public function filterAdminsWithPostCount($filters = [])
    {
        return $this->adminRepo->filterWithPostCount($filters);
    }

    public function findAdmin($id)
    {
        return $this->adminRepo->find($id);
    }

    public function createAdmin(array $data)
    {
        return $this->adminRepo->create($data);
    }

    public function updateAdmin($id, array $data)
    {
        return $this->adminRepo->update($id, $data);
    }

    public function banAdmin($id)
    {
        return $this->adminRepo->ban($id);
    }

    public function unbanAdmin($id)
    {
        return $this->adminRepo->unban($id);
    }
}
