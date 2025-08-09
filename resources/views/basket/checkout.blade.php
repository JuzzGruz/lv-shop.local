@extends('layouts.site')

@section('content')
    <h1 class="mb-4">Оформить заказ</h1>
    @if ($profiles && $profiles->count())
        @include('basket.part.select', ['current' => $profile->id ?? 0])
    @endif
    <form method="post" action="{{ route('basket.saveorder') }}">
        @csrf
        <div class="mb-3">
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="name" placeholder="Имя, Фамилия"
                maxlength="255" value="{{ old('name') ?? $profile->name ?? session('old_order_value')['name'] ?? $user->name ?? '' }}">
        </div>
        <div class="mb-3">
            <input type="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="email" placeholder="Адрес почты"
                maxlength="255" value="{{ old('email') ?? $profile->email ?? session('old_order_value')['email'] ?? $user->email ?? '' }}">
        </div>
        <div class="mb-3">
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="phone" placeholder="Номер телефона"
                maxlength="255" value="{{ old('phone') ?? $profile->phone ?? session('old_order_value')['phone'] ?? '' }}">
        </div>
        <div class="mb-3">
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="address" placeholder="Адрес доставки"
                maxlength="255" value="{{ old('address') ?? $profile->address ?? session('old_order_value')['address'] ?? '' }}">
        </div>
        <div class="mb-3">
            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="comment" placeholder="Комментарий"
                    maxlength="255" rows="2">{{ old('comment') ?? $profile->comment ?? session('old_order_value')['comment'] ?? '' }}</textarea>
        </div>
        <div class="">
            <button type="submit" class="btn btn-success">Оформить</button>
        </div>
    </form>
@endsection
