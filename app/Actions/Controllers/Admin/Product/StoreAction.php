<?php

namespace App\Actions\Controllers\Admin\Product;

use App\Actions\Traits\ImgControll;
use App\Facades\ActionImg;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

final class StoreAction
{
    use ImgControll;
    
    public function __invoke($data) : Model
    {
        $data['image'] = ActionImg::save('/img/product', $data);
        $product = Product::create($data);

        return $product;
    }
}
