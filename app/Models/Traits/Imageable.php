<?php

namespace App\Models\Traits;
use Illuminate\Support\Facades\Storage;

trait Imageable {

    public function imageable()
    {
        $file = request()->file('image');
        return  Storage::disk('public')->put('images', $file);
    }

    public function updateImageable()
    {
        if (request()->file('image')) {
            Storage::delete($this->image);
            $this->storeImage();
        }
        return;
    }
}
