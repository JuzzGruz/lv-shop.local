@extends('layouts.adminPanel', ['title' => 'Показ страницы'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Просмотр страницы</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <div class="row">
        <div class="col-12">
            <p><strong>Название:</strong> {{ $page->name }}</p>
            <p><strong>URL:</strong> {{ $page->slug }}</p>
            <p><strong>Контент (html)</strong></p>
            <div class="mb-4 bg-white p-1">
                {!! $page->content !!}
            </div>

            <a href="{{ route('admin.page.edit', ['page' => $page->id]) }}"
               class="btn btn-success">
                Редактировать страницу
            </a>
            <form method="post" class="d-inline"  onsubmit="return confirm('Удалить эту страницу?')"
                  action="{{ route('admin.page.destroy', ['page' => $page->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Удалить страницу
                </button>
            </form>
        </div>
    </div>
@endsection
