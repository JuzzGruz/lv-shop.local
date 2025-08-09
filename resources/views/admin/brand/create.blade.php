@extends('layouts.adminPanel', ['title' => 'Добавление бренда'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="fw-bold fs-4">Создание бренда</p>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form action="{{ route('admin.brand.store') }}" class="w-50" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3"> 
            <label for="" class="block font-medium text-sm text-gray-700">Название бренда</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="name">
        </div>
        <div class="mb-3"> 
            <label for="" class="block font-medium text-sm text-gray-700">Описание бренда</label>
            <textarea name="content" cols="30" rows="10" placeholder="Необязательно, максимум 200 символов" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" style="resize: none"></textarea>
        </div>
        <div class="mb-3"> 
            <label for="" class="block font-medium text-sm text-gray-700">Изображение бренда</label>
            <input type="file" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="image">
        </div>
        <input type="submit" class="btn btn-primary" value="Создать">
    </form>
@endsection
