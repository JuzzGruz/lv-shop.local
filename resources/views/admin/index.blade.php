@extends('layouts.adminPanel', ['title' => 'Главная страница администрации'])

@section('content')
        <h1>Интернет-магазин</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ducimus eveniet...</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores corporis...</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aspernatur assumenda...</p>
        <a class="btn btn-primary" href="{{ route('admin.image.index') }}">Картиночки</a>
@endsection
