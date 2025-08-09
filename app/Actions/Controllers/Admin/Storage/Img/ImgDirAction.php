<?php

namespace App\Actions\Controllers\Admin\Storage\Img;

use App\Actions\Controllers\Admin\Storage\DirectoryInterface;
use Illuminate\Support\Facades\Storage;

class ImgDirAction implements DirectoryInterface
{
    /**
     * Возвращает массив с директориями всех файлов в папке img
     */
    public function getAllDirectories() : array
    {
        $allFiles = Storage::disk('public')->allFiles('/img');
        //Черный список
        $filt = [
            //для плейсхолдеров
            'place',
            //для папки с картинками ошибок
            'error',
            ];
        foreach($allFiles as $key => $a) {
            foreach ($filt as $f) {
                if (str_contains($a, $f)) {
                    unset($allFiles[$key]);
                }
            }
        }

        return $allFiles;
    }
}
