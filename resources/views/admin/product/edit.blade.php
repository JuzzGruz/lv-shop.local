@extends('layouts.adminPanel', ['title' => 'Редактирование продукта'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Редактирование товара</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form action="{{ route('admin.product.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-md-12 p-0 m-0 row">
            <div class="col-md-6">
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">Название товара</label>
                    <input type="text" value="{{ $product->name }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="name">
                </div>
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">URL</label>
                    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="slug" value="{{ $product->slug }}">
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Категория</label>
                    <select name="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" title="Категория">
                        <option value="0">Выберите</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $product->category_id ? ' selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Бренд</label>
                    <select name="brand_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" title="Бренд">
                        <option value="0">Выберите</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ $brand->id == $product->brand_id ? ' selected' : '' }}
                          >{{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Цена</label>
                    <input type="text" value="{{ $product->price }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="price">
                </div>
                <div class="mb-3">
                    <label for="" class="block font-medium text-sm text-gray-700">Количество</label>
                    <input type="text" value="{{ $product->amount }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="amount">
                </div>
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">Изображение товара</label>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <input type="file" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="image">
                </div>
                <input type="submit" class="btn btn-primary" value="Обновить">
            </div>
            <div class="col-md-6">
                <div class="mb-3"> 
                    <label for="" class="block font-medium text-sm text-gray-700">Описание товара</label>
                    <textarea name="content" cols="30" rows="10" placeholder="Необязательно, максимум 500 символов" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" style="resize: none">{!! $product->content !!}</textarea>
                </div>
            </div>
        </div>
    </form>
@endsection
