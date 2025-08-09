<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

/**
*   Класс проверяет наличие картинки в массиве
*   Записывает, заменяет или удаляет картинку с диска
**/

class ActionImgHelper
{
    /** Сохраняет картинку на диск, при ее наличии,
     *  и возвращает путь к этому изображению
     **/
    public function save(string $path,array $data) : ?string
    {
        if ( array_key_exists('image',$data)) {
            $data['image'] = Storage::disk('public')->put($path, $data['image']);
            return $data['image'];
        }
        
        return null;
    }
    /**
     * Удаляет старую картинку с диска, при наличии
     * пути к ней в БД, и заменяет ее на новую
     **/
    public function update(object $model,string $path,array $data) : ?string
    {
        if ( array_key_exists('image',$data)) {
            $delete = $model->image;
            isset($delete) ? Storage::disk('public')->delete($delete) : null ;
            $path = Storage::disk('public')->put($path, $data['image']);
            return $path;
        }

        return null;
    }
    // Удаляет картинку модели с диска, при наличии пути к ней в БД
    public function delete(object $model) : void
    {
        if ( $model->image ) {
            Storage::disk('public')->delete($model->image);
        }
    }
}