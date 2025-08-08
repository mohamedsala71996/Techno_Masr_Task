<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageHandler
{
    /**
     * Update a polymorphic single image for a model.
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $imagePath
     * @param string $type
     * @return void
     */
    public function updateMorphImage($model, $imagePath, $type )
    {
        $oldImage = $model->images()->where('type', $type)->first();
        if ($oldImage && $oldImage->path) {
            Storage::disk('public')->delete($oldImage->path);
            $oldImage->delete();
        }
        $model->images()->create([
            'path' => $imagePath,
            'type' => $type,
        ]);
    }

    /**
     * Delete a polymorphic image for a model by type.
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $type
     * @return void
     */
    public function deleteMorphImage($model, $type)
    {
        $image = $model->images()->where('type', $type)->first();
        if ($image && $image->path) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }
}
