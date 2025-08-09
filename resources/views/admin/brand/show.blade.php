@extends('layouts.adminPanel', ['title' => 'Просмотр бренда'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Просмотр бренда</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Название:</strong> {{ $brand->name }}</p>
            <p><strong>ЧПУ (англ):</strong> {{ $brand->slug }}</p>
            <p><strong>Краткое описание</strong></p>
            @isset($brand->content)
                <p>{{ $brand->content }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
        </div>
        <div class="col-md-6">
            <img src="{{ asset('Storage/' . $brand->get_img()) }}"
                 alt="" class="" style='max-height: 400px; max-weight: 400px'>
        </div>
    </div>
    @if ($brand->products->count())
        <p><strong>Товары бренда</strong></p>
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="45%">Наименование</th>
                <th width="45%">ЧПУ (англ)</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($brand->products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('admin.product.show', $product->slug) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ $product->slug }}</td>
                    <td>
                        <a href="{{ route('admin.product.edit', $product->slug) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.product.destroy', $product->slug) }}"
                            method="post" onsubmit="return confirm('Удалить?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p><strong>Товары отсутсвуют</strong></p>
    @endif
@endsection
