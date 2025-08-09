<?php

namespace App\Actions\Traits;

use Illuminate\Support\Facades\Storage;

trait ImgControll
{
    protected $img;

    public function store_img($img, $path) : string
    {
        $path = Storage::disk('public')->put($path, $img);

        return $path;
    }

    public function edit_img($img, $path, $model) : string
    {
        $delete = $model->image;
        isset($delete) ? Storage::disk('public')->delete($delete) : null ;
        $path = Storage::disk('public')->put($path, $img);
        
        return $path;
    }

    public function delete_img($model) : void
    {
        Storage::disk('public')->delete($model->image);
    }
}
