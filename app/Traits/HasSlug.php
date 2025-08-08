<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function ($model) {
            $slugSourceColumn = property_exists($model, 'slugSource') ? $model::$slugSource : 'title';

            if (empty($model->slug) && !empty($model->{$slugSourceColumn})) {
                $originalSlug = Str::slug($model->{$slugSourceColumn});
                $slug = $originalSlug;
                $count = 1;

                while ($model->newQuery()->where('slug', $slug)->where('id', '!=', $model->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                $model->slug = $slug;
            }
        });
    }
}
