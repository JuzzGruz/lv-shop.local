@extends('layouts.adminPanel', ['title' => 'Просмотр пользователя'])

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Просмотр пользователя</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <div>
        <p>Имя: {{ $user->name }}</p>
        <p>Почтовый ящик: {{ $user->email }}</p>
    </div>
    <div>
        <h2>Заказы пользователя</h2>
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="18%">Дата и время</th>
                <th width="5%">Статус</th>
                <th width="18%">Имя</th>
                <th width="18%">Адрес почты</th>
                <th width="18%">Номер телефона</th>
                <th width="18%">Пользователь</th>
                <th><i class="fas fa-eye"></i></th>
                <th><i class="fas fa-edit"></i></th>
            </tr>
            @foreach($user->orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        @if ($order->status == 0)
                            <span class="text-danger">{{ $status[$order->status] }}</span>
                        @elseif (in_array($order->status, [1,2,3]))
                            <span class="text-success">{{ $status[$order->status] }}</span>
                        @else
                            {{ $status[$order->status] }}
                        @endif
                    </td>
                    <td>{{ $order->name }}</td>
                    <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        @isset($order->user)
                            {{ $order->user->name }}
                        @endisset
                    </td>
                    <td>
                        <a href="{{ route('admin.order.show', $order->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                              </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.order.edit', $order->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
