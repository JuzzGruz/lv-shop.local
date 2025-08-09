<?php

namespace App\Actions\Controllers\Admin\Storage\Img;

use Illuminate\Support\Facades\Storage;

class ImgSaveAction
{
    public function save(string $path, mixed $img, bool $return=false) : ?string
    {
        $img = Storage::disk('public')->put($path, $img);
        if ($return) {
            return $img;
        };
        return null;
    }
}
