<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Traits\ImageHandler;

class UserRepository implements UserRepositoryInterface
{
    use ImageHandler;
    public function allWithPostCount()
    {
        return User::withCount('posts')->get();
    }

    public function filterWithPostCount($filters = [])
    {
        $query = User::query()->withCount('posts');
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
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        $user = User::create($data);
        return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        if (isset($data['password']) && $data['password']) {
            $user->password = bcrypt($data['password']);
        }
        unset($data['password']);
        $user->update($data);
        return $user;
    }

    public function ban($id)
    {
        $user = $this->find($id);
        $user->is_banned = true;
        $user->save();
        return $user;
    }

    public function unban($id)
    {
        $user = $this->find($id);
        $user->is_banned = false;
        $user->save();
        return $user;
    }


}
