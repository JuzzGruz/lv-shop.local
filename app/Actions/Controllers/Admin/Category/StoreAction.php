<?php

namespace App\Actions\Controllers\Admin\Category;

use App\Actions\Traits\ImgControll;
use App\Facades\ActionImg;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

final class StoreAction
{
    use ImgControll;
    
    public function __invoke($data) : Model
    {
        $data['image'] = ActionImg::save('/img/category', $data);
        $category = Category::create($data);

        return $category;
    }
}
