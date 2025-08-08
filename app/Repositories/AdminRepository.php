<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository implements AdminRepositoryInterface
{
    public function allWithPostCount()
    {
        return Admin::withCount('posts')->get();
    }

    public function filterWithPostCount($filters = [])
    {
        $query = Admin::query()->withCount('posts');
        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }
        if (!empty($filters['status'])) {
            if ($filters['status'] === 'active') {
                $query->where('is_banned', false);
            } elseif ($filters['status'] === 'banned') {
                $query->where('is_banned', true);
            }
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
        return Admin::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $admin = $this->find($id);
        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $admin->update($data);
        return $admin;
    }

    public function create(array $data)
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
        }
        return Admin::create($data);
    }

    public function ban($id)
    {
       $admin = Admin::first();
       if ($admin->id == $id) {
           throw new \Exception('لا يمكن حظر أول مشرف (الإدارة الرئيسية)');
       }
        $admin = $this->find($id);
        $admin->is_banned = true;
        $admin->save();
        return $admin;
    }

    public function unban($id)
    {
        $admin = $this->find($id);
        $admin->is_banned = false;
        $admin->save();
        return $admin;
    }
}
