<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    protected static $noImg = 'img/400x120_default_image_placeholder.png';

    public function get_img() : string 
    {
        if ($this->check_img()) {
            return $this->image;
        }
        
        return static::$noImg;
    }

    public function check_img() : bool
    {
        if ($this->image) {
            if (Storage::disk('public')->exists($this->image)) {
                return true;
            }
        }

        return false;
    }
}
