@extends('layouts.adminPanel', ['title' => 'Редактирование страницы'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Редактирование страницы</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="post" action="{{ route('admin.page.update', $page->id) }}">
        @method('PUT')
        @include('admin.page.part.form')
    </form>
@endsection
