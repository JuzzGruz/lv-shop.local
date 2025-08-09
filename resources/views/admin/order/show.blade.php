@extends('layouts.adminPanel', ['title' => 'Просмотр заказа'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Просмотр заказа</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <div class="row m-0">
        @foreach ($status as $key => $value)
            <form action="{{ route('admin.order.update', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{ $key }}">
                @if ($key == $order->status)
                    <button type="submit" class="btn btn-success">{{ $value }}</button>
                @else
                    <button type="submit" class="btn btn-primary">{{ $value }}</button>
                @endif
            </form>
        @endforeach
    </div>
    <div>
        <h1>Данные по заказу № {{ $order->id }}</h1>

        <p>
            Статус заказа:
            @if ($order->status == 0)
                <span class="text-danger">{{ $status[$order->status] }}</span>
            @elseif (in_array($order->status, [1,2,3]))
                <span class="text-success">{{ $status[$order->status] }}</span>
            @else
                {{ $status[$order->status] }}
            @endif
        </p>

        <h3 class="mb-3">Состав заказа</h3>
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Стоимость</th>
            </tr>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2, '.', '') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->cost, 2, '.', '') }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-right">Итого</th>
                <th>{{ number_format($order->amount, 2, '.', '') }}</th>
            </tr>
        </table>

        <h3 class="mb-3">Данные покупателя</h3>
        <p>Имя, фамилия: {{ $order->name }}</p>
        <p>Адрес почты: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
        <p>Номер телефона: {{ $order->phone }}</p>
        <p>Адрес доставки: {{ $order->address }}</p>
        @isset ($order->comment)
            <p>Комментарий: {{ $order->comment }}</p>
        @endisset
    </div>
@endsection
