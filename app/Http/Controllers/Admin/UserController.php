<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{

    //Главная страница
    public function index() : View
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    //Страница просмотра
    public function show(User $user) : View 
    {
        $status = Order::STATUS;
        return view('admin.user.show', compact('user', 'status'));
    }

    //Страница редактирования
    public function edit(User $user) : View
    {
        return view('admin.user.edit', compact('user'));
    }

    //Обновление данных в базе
    public function update(ProfileUpdateRequest $request, User $user) : RedirectResponse
    {
        $data = $request->validated();

        $user->update($data);

        return redirect()
            ->route('admin.user.index')
            ->with('success', "Пользователь №$user->id отредактирован");
    }

    //Удаление из базы
    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', "Пользователь №$user->id удалён");
    }
    
}
