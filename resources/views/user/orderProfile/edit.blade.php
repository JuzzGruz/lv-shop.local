@php
    $add = Auth::user()->admin ? 'adminPanel' : 'site';
@endphp
@extends('layouts.' . $add)

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Редактирование профиля</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="post" action="{{ route('user.orderProfile.update', $profile->id) }}">
        @method('PUT')
        @include('user.orderProfile.part.form')
    </form>
@endsection
