@php
    $add = Auth::user()->admin ? 'adminPanel' : 'site';
@endphp
@extends('layouts.' . $add)

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Данные профиля</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>

    <p><strong>Название профиля:</strong> {{ $profile->title }}</p>
    <p><strong>Имя, фамилия:</strong> {{ $profile->name }}</p>
    <p>
        <strong>Адрес почты:</strong>
        <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
    </p>
    <p><strong>Номер телефона:</strong> {{ $profile->phone }}</p>
    <p><strong>Адрес доставки:</strong> {{ $profile->address }}</p>
    @isset ($profile->comment)
        <p><strong>Комментарий:</strong> {{ $profile->comment }}</p>
    @endisset

    <a href="{{ route('user.orderProfile.edit', $profile->id) }}"
       class="btn btn-success">
        Редактировать профиль
    </a>
    <form method="post" class="d-inline" onsubmit="return confirm('Удалить этот профиль?')"
          action="{{ route('user.orderProfile.destroy', $profile->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Удалить профиль
        </button>
    </form>
@endsection
