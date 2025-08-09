<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
* @method static \App\Helpers\ActionImgHelper save(string $path, array $data)
* @method static \App\Helpers\ActionImgHelper update(object $model, string $path, array $data)
* @method static \App\Helpers\ActionImgHelper delete(object $model)
**/
class ActionImg extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'actionimg';
    }
}