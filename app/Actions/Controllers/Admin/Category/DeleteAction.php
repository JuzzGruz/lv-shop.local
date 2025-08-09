<?php

namespace App\Actions\Controllers\Admin\Category;

use App\Actions\Traits\ImgControll;
use App\Facades\ActionImg;
use App\Models\Category;

final class DeleteAction
{
    use ImgControll;

    public function __invoke(Category $category) : string
    {
        ActionImg::delete($category);
        $category->delete();

        return $category->name;
    }
}
