@extends('layouts.site')

@section('content')
    @if (count($top_products))
        <h2 class="mb-4">Популярные товары</h2>
        <div class="row">
            @foreach ($top_products as $product)
                @include('catalog.components.product', [$product, $top = 1])
            @endforeach
            @php unset($top) @endphp
        </div>
    @endif
    @if (count($new_products))
        <h2 class="mb-4">Новые товары</h2>
        <div class="row">
            @foreach ($new_products as $product)
                @include('catalog.components.product', [$product, $new = 1])
            @endforeach
            @php unset($new) @endphp
        </div>
    @endif
@endsection
