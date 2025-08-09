@php
    $add = Auth::user()->admin ? 'adminPanel' : 'site';
@endphp
@extends('layouts.' . $add)

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Ваши профили</h1>
        <a href="{{ URL::previous() }}" class="btn btn-primary d-flex align-items-center">Назад</a>
    </div>
    <a href="{{ route('user.orderProfile.create') }}" class="btn btn-success mb-4">
        Создать профиль
    </a>

    @if (count($profiles))
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="22%">Наименование</th>
                <th width="22%">Имя, Фамилия</th>
                <th width="22%">Адрес почты</th>
                <th width="22%">Номер телефона</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach($profiles as $profile)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('user.orderProfile.show', $profile->id) }}">
                            {{ $profile->title }}
                        </a>
                    </td>
                    <td>{{ $profile->name }}</td>
                    <td><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></td>
                    <td>{{ $profile->phone }}</td>
                    <td>
                        <a href="{{ route('user.orderProfile.edit', $profile->id) }}">
                            <i class="fa-solid fa-pencil" style="color: #006bbd;"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('user.orderProfile.destroy', $profile->id) }}"
                              method="post" onsubmit="return confirm('Удалить этот профиль?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fa-solid fa-trash-can" style="color: #ad0101;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $profiles->links() }}
    @endif
@endsection
