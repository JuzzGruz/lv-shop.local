@extends('layouts.site', ['title' => $category->name])

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->content }}</p>
    <div class="row">
        @foreach ($category->products as $product)
            @include('catalog.components.product')
        @endforeach
    </div>
    <h5 class="bg-info text-white p-2 mb-4">Товары раздела</h5>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.components.product', $product)
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
