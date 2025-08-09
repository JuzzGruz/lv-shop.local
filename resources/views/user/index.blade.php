@php
    $add = Auth::user()->admin ? 'adminPanel' : 'site';
@endphp
@extends('layouts.' . $add)

@section('content')
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}!</p>
    <p>Это личный кабинет постоянного покупателя нашего интернет-магазина.</p>
    <ul>
        <li class="pb-2"><a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Редактировать профиль</a></li>
        <li class="pb-2"><a href="{{ route('user.orderProfile.index') }}" class="btn btn-primary">Ваши профили заказов</a></li>
        <li class="pb-2"><a href="{{ route('user.order.index') }}" class="btn btn-primary">История заказов</a></li>
    </ul>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Выйти из аккаунта</button>
    </form>
@endsection