<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Image
{
    public function StoreImage($request, $field, $path)
    {
        if ($request->hasFile($field)) {
            $image = $request->file($field);
            $path = $image->store($path, 'public');
            return $path;
        }

        return null;
    }

    public function UpdateImage($request, $field, $path, $old_path)
    {
        if ($request->hasFile($field)) {
            $image = $request->file($field);
            $path = $image->store($path, 'public');
            return $path;
        }

        return $old_path;
    }

    public function deleteImage($old_path,$path)
    {
        if ($old_path) {
            Storage::disk($path)->delete($old_path);
        }
    }
}
