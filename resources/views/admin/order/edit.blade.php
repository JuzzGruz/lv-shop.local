@extends('layouts.adminPanel', ['title' => 'Редактирование заказа'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="mb-4">Редактирование заказа</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <form method="post" action="{{ route('admin.order.update', $order->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Статус заказа</label>
            @php $statusOrder = old('status') ?? $order->status ?? 0 @endphp
            <select name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" title="Статус заказа">
                @foreach ($status as $key => $value)
                    <option value="{{ $key }}" @if ($key == $statusOrder) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Имя</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ old('name') ?? $order->name ?? '' }}">
        </div>
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Эл.почта</label>
            <input type="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? $order->email ?? '' }}">
        </div>
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Номер телефона</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="phone" placeholder="Номер телефона"
                   required maxlength="255" value="{{ old('phone') ?? $order->phone ?? '' }}">
        </div>
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Адрес доставки</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="address" placeholder="Адрес доставки"
                   required maxlength="255" value="{{ old('address') ?? $order->address ?? '' }}">
        </div>
        <div class="form-group">
            <label for="" class="block font-medium text-sm text-gray-700">Комментарий</label>
            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="comment" placeholder="Комментарий"
                      maxlength="255" rows="2">{{ old('comment') ?? $order->comment ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
    <form action="{{ route('admin.order.destroy', $order->id) }}" method="post" onsubmit="return confirm('Вы уверены? Количество товара будет возвращено обратно в базу, а восстановить заказ будет невозможно');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Отменить заказ</button>
    </form>
@endsection
