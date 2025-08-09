<?php

namespace App\Actions\Controllers\Admin\Storage\Img;

use Illuminate\Support\Facades\Storage;

class ImgDeleteAction
{
    public function delete(string $path) : string
    {
        Storage::disk('public')->delete($path);

        return 'Картинка успешно удалена';
    }
}
