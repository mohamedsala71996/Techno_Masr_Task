<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasSlug;

    protected static string $slugSource = 'title';
 

    protected $fillable = ['author_id', 'author_type','category_id', 'title', 'slug', 'description', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images() // we need now one image but i used morphMany to make it easy to add more images in the future
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function author()
    {
        return $this->morphTo();
    }

    public function getMainImageAttribute()
    {
        $image = $this->images->where('type', 'main_image')->first();
        return $image ? asset('storage/' . $image->path) : asset('default.png');
    }
}
