<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Controllers\Admin\Storage\Img\ImgDeleteAction;
use App\Actions\Controllers\Admin\Storage\Img\ImgDirAction;
use App\Actions\Controllers\Admin\Storage\Img\ImgSaveAction;
use App\Helpers\DirectoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Storage\Img\ImgUploadRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImgController extends Controller
{
    public function getAllImg(DirectoryHelper $dir) : View
    {
        $images = $dir->getAll(new ImgDirAction);
        return view('admin.image.index', compact('images'));
    }

    public function upload(ImgUploadRequest $request, ImgSaveAction $action) : RedirectResponse
    {
        $data = $request->validated();
        $path = $action->save('/img/uploads', $data['image'], true);

        return redirect()
            ->route('admin.image.index')
            ->with('success', "Картинка сохранена в директорию: $path");
    }

    public function delete(Request $request, ImgDeleteAction $action) : RedirectResponse
    {
        $request->validate([
            'path' => 'required|string'
        ]);
        $message = $action->delete($request['path']);

        return redirect()
            ->route('admin.image.index')
            ->with('success', $message);
    }
}
