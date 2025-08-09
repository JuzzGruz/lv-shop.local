@extends('layouts.adminPanel', ['title' => 'Все картинки'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Все картинки</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form action="{{ route('admin.image.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        Загрузить картинку:
        <input type="file" name="image">
        <button type="submit" class="btn btn-primary">Загрузить</button>
    </form>
    <div class="d-flex">
        @foreach ($images as $img)
            <div class="card h-25 w-25">
                <img src="{{ asset('Storage/' . $img) }}" alt="" class="img-fluid">
                Директория изображения:
                {{$img}}
                <form action="{{ route('admin.image.delete') }}" method="post" onsubmit="return confirm('Удалить?')">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="path" value="{{ $img }}">
                    <button type="submit">
                        <i class="fas fa-trash-alt" style="color: #b90404;"></i>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
