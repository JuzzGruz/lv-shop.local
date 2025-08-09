@extends('layouts.adminPanel', ['title' => 'Создание категории'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="fw-bold fs-4">Создание категории</p>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form action="{{ route('admin.category.store') }}" class="row" method="POST" enctype="multipart/form-data">
        @include('admin.category.part.form')
    </form>
@endsection
