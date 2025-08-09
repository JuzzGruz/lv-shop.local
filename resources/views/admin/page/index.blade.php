@extends('layouts.adminPanel', ['title' => 'Страницы сайта'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="mb-3">Все страницы сайта</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <a href="{{ route('admin.page.create') }}" class="btn btn-success mb-4">
        Создать страницу
    </a>
    @if (isset($pages) && count($pages))
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th width="45%">Наименование</th>
                    <th width="45%">URL</th>
                    <th><i class="fas fa-edit"></i></th>
                    <th><i class="fas fa-trash-alt"></i></th>
                </tr>
            </thead>
            <tbody>
                @include('admin.page.part.tree', ['level' => -1, 'parent' => 0])
            </tbody>
        </table>
    @endif
@endsection
