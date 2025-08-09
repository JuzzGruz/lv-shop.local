@extends('layouts.adminPanel', ['title' => 'Показ продукта'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Просмотр товара</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Название:</strong> {{ $product->name }}</p>
            <p><strong>Бренд:</strong> {{ $product->brand->name}}</p>
            <p><strong>Категория:</strong> {{ $product->category->name }}</p>
            <p><strong>Цена:</strong> {{ $product->price }}</p>
            <p><strong>Количество:</strong> {{ $product->amount }}</p>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('Storage/' . $product->get_img()) }}"
                 alt="" class="" style='max-height: 400px; max-weight: 400px'>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p><strong>Описание</strong></p>
            @isset($product->content)
                <p>{{ $product->content }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
            <a href="{{ route('admin.product.edit', $product->slug) }}"
               class="btn btn-success">
                Редактировать товар
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Удалить этот товар?')"
                  action="{{ route('admin.product.destroy', $product->slug) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Удалить товар
                </button>
            </form>
        </div>
    </div>
@endsection
