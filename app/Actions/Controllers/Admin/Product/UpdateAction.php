<?php

namespace App\Actions\Controllers\Admin\Product;

use App\Actions\Traits\ImgControll;
use App\Facades\ActionImg;
use App\Models\Product;

final class UpdateAction
{
    use ImgControll;
    
    public function __invoke(Product $product, $data) : void
    {
        $data['image'] = ActionImg::update($product, '/img/product', $data);
        $product->update($data);
    }
}
