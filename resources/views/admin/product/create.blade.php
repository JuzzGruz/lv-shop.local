@extends('layouts.adminPanel', ['title' => 'Добавление продукта'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Создание нового товара</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12 p-0 m-0 row">
            <div class="col-md-6">
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">Название товара</label>
                    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" 
                        name="name" value="{{ old('name') }}">
                </div>
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">URL</label>
                    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" 
                        name="slug" value="{{ old('slug') }}" placeholder="Оставьте поле пустым для автогенерации">
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Категория</label>
                    <select name="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" title="Категория">
                        <option value="0">Выберите</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id') ? ' selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Бренд</label>
                    <select name="brand_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" title="Бренд">
                        <option value="0">Выберите</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ $brand->id == old('brand_id') ? ' selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Цена</label>
                    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" 
                        name="price" value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Количество</label>
                    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" 
                        name="amount" value="{{ old('amount') }}">
                </div>
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">Изображение товара</label>
                    <input type="file" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" name="image">
                </div>
                <input type="submit" class="btn btn-primary" value="Создать">
            </div>
            <div class="col-md-6">
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">Описание товара</label>
                    <textarea name="content" cols="30" rows="10" placeholder="Необязательно, максимум 500 символов" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" style="resize: none">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>
    </form>
@endsection
