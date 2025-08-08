<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasSlug;

    protected static string $slugSource = 'name';

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::saving(function ($category) {
    //         if (empty($category->slug) && !empty($category->name)) {
    //             $category->slug = str()->slug($category->name);
    //         }
    //     });
    // }

    protected $fillable = ['name', 'slug', 'parent_id'];

    protected $appends = ['depth'];

    public function getDepthAttribute()
    {
        return $this->attributes['depth'] ?? 0;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
