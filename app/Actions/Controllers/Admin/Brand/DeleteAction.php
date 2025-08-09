<?php

namespace App\Actions\Controllers\Admin\Brand;

use App\Facades\ActionImg;
use App\Models\Brand;

final class DeleteAction
{
    public function __invoke(Brand $brand) : string
    {
        ActionImg::delete($brand);
        $brand->delete();

        return $brand->name;
    }
}
