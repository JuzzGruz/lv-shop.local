@extends('layouts.site')

@section('content')
<h1>Ваша корзина</h1>
@if (isset($basket->products) && count($basket->products))
    @php
        $basketCost = 0;
    @endphp
    <form action="{{ route('basket.clear') }}" method="post" class="text-right">
        @csrf
        <button type="submit" class="btn btn-outline-danger mb-4 mt-0">
            Очистить корзину
        </button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Кол-во</th>
            <th>Стоимость</th>
        </tr>
        @foreach($basket->products as $product)
            @php
                $itemPrice = $product->price;
                $itemQuantity =  $product->pivot->quantity;
                $itemCost = $itemPrice * $itemQuantity;
                $basketCost = $basketCost + $itemCost;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('catalog.product', $product->slug) }}">{{ $product->name }}</a>
                </td>
                <td>{{ number_format($itemPrice, 2, '.', '') }}</td>
                <td>
                    <form action="{{ route('basket.minus', $product->id) }}"
                          method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dash-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1z"/>
                            </svg>
                        </button>
                    </form>
                    <span class="mx-1">{{ $itemQuantity }}</span>
                    <form action="{{ route('basket.plus', $product->id) }}"
                          method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </button>
                    </form>
                </td>
                <td>{{ number_format($itemCost, 2, '.', '') }}</td>
                <td>
                    <form action="{{ route('basket.remove', $product->id) }}"
                          method="post">
                        @csrf
                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-right">Итого</th>
            <th>{{ $basket->get_amount() }}</th>
        </tr>
    </table>
    <a href="{{ route('basket.checkout') }}" class="btn btn-success">Оформить заказ</a>
@else
    <p>Ваша корзина пуста</p>
@endif
@endsection
