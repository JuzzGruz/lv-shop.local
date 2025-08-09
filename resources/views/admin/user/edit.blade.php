@extends('layouts.adminPanel', ['title' => 'Редактирование пользователя'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Редактирование пользователя</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="post" action="{{ route('admin.user.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Имя пользователя</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ old('name') ?? $user->name ?? '' }}">
        </div>
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Почтовый ящик</label>
            <input type="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? $user->email ?? '' }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
@endsection
