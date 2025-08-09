<?php

namespace App\Actions\Controllers\Admin\Product;

use App\Actions\Traits\ImgControll;
use App\Facades\ActionImg;
use App\Models\Product;

final class DeleteAction
{
    use ImgControll;

    public function __invoke(Product $product) : string
    {
        ActionImg::delete($product);
        $product->delete();

        return $product->name;
    }
}
