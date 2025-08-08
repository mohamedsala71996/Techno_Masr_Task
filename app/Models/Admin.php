<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles, Notifiable;
    protected $fillable = ['name', 'email', 'password', 'is_banned'];

    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }   
}