@extends('layouts.site')

@section('content')
    @if (isset($result))
        <h2 class="mb-4">Результаты поиска</h2>
        <div class="row">
            @foreach ($result as $product)
                @include('catalog.components.product', $product)
            @endforeach
        </div>
    @else
        <h1>Каталог товаров</h1>

        <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ducimus, eligendi exercitationem expedita,
        iure iusto laborum magnam qui quidem repellat similique tempora tempore ullam! Deserunt doloremque impedit
        quis repudiandae voluptas.
        </p>
        <h2 class="mb-4">Разделы каталога</h2>
        <div class="row">
            @foreach ($roots as $category)
                @include('catalog.components.category', $category)
            @endforeach
        </div>

        <h2 class="mb-4">Популярные бренды</h2>
        <div class="row">
            @foreach ($brands as $brand)
                @include('catalog.components.brand', $brand)
            @endforeach
        </div>
    @endif
@endsection
