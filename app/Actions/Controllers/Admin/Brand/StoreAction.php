<?php

namespace App\Actions\Controllers\Admin\Brand;

use App\Facades\ActionImg;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

final class StoreAction
{
    public function __invoke($data) : Model
    {
        $data['image'] = ActionImg::save('/img/brand', $data);
        $brand = Brand::create($data);

        return $brand;
    }
}
