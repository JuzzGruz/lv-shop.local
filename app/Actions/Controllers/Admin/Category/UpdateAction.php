<?php

namespace App\Actions\Controllers\Admin\Category;

use App\Actions\Traits\ImgControll;
use App\Facades\ActionImg;
use App\Models\Category;

final class UpdateAction
{
    use ImgControll;
    
    public function __invoke(Category $category, $data) : void
    {
        $data['image'] = ActionImg::update($category, '/img/category', $data);
        $category->update($data);
    }
}
