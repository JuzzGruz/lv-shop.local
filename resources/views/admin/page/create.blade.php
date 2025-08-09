@extends('layouts.adminPanel', ['title' => 'Создание страницы'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Создание новой страницы</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="post" action="{{ route('admin.page.store') }}">
        @include('admin.page.part.form')
    </form>
@endsection
