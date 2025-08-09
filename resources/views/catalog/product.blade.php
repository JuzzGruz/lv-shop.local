@extends('layouts.site')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1>{{ $product->name }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('Storage/' . $product->get_img()) }}"
                             alt="" class="" style='max-height: 400px; max-weight: 400px'>
                    </div>
                    <div class="col-md-6">
                        <p>Цена: {{ number_format($product->price, 2, '.', '') }}</p>
                        <p>Кол-во: {{ $product->amount }}</p>
                        <!-- Форма для добавления товара в корзину -->
                        <form action="{{ route('basket.add', $product->id) }}"
                              method="post" class="form-inline add-to-basket">
                            @csrf
                                @if ($product->amount > 0)
                                    <label for="input-quantity">Количество</label>
                                    <input type="text" name="quantity" id="input-quantity" value="1"
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-2 w-25">
                                    <button type="submit" class="btn btn-success">Добавить в корзину</button>
                                @else
                                    <button type="submit" disabled class="btn btn-danger">Нет в наличии</button>
                                @endif
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="mt-4 mb-0">{{ $product->content }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        Категория:
                        <a href="{{ route('catalog.category', $product->category->slug) }}">
                            {{ $product->category->name }}
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        Бренд:
                        <a href="{{ route('catalog.brand', $product->brand->slug) }}">
                            {{ $product->brand->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
