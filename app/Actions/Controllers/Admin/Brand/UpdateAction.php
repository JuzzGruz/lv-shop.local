<?php

namespace App\Actions\Controllers\Admin\Brand;

use App\Facades\ActionImg;
use App\Models\Brand;

final class UpdateAction
{
    public function __invoke($data, Brand $brand) : void
    {
        $data['image'] = ActionImg::update($brand, '/img/brand', $data);
        $brand->update($data);
    }
}
