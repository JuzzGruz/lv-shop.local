<?php

namespace App\Helpers;

use App\Actions\Controllers\Admin\Storage\DirectoryInterface;

class DirectoryHelper
{
    public function getAll(DirectoryInterface $dir) : array
    {
        return $dir->getAllDirectories();
    }
}
