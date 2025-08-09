@extends('layouts.adminPanel', ['title' => 'Редактирование категории'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="fw-bold fs-4">Редактирование категории</p>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form action="{{ route('admin.category.update', $category->slug) }}" class="row" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @include('admin.category.part.form')
    </form>
@endsection
