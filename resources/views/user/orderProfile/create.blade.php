@php
    $add = Auth::user()->admin ? 'adminPanel' : 'site';
@endphp
@extends('layouts.' . $add)

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Создание профиля</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="post" action="{{ route('user.orderProfile.store') }}">
        @include('user.orderProfile.part.form')
    </form>
@endsection
