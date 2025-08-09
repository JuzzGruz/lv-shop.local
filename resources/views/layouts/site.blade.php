<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Магазин' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"><!--Bootstrap v4.4.1-->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-6.7.2-web/css/all.css') }}" /><!--FontAwesome-->
    <link rel="stylesheet" href="{{ asset('plugins\bootstrap-icons-1.11.3\font\bootstrap-icons.css') }}">
    <script src="{{ asset('assets/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid m-0 p-0">
                <!-- Бренд и кнопка «Гамбургер» -->
                <a class="navbar-brand" href="/">Магазин</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbar-example" aria-controls="navbar-example"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
                <div class="navbar-collapse" id="navbar-example">
                    <!-- Этот блок расположен слева -->
                    <div class="container m-0 p-0">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('catalog.index') }}">Каталог</a>
                            </li>
                            @include('layouts.part.pages')
                        </ul>
                    </div>
                    <form action="{{ route('catalog.search') }}" class="d-flex justify-content-end">
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-sm-2" type="search" name="query"
                               placeholder="Поиск по каталогу" aria-label="Search">
                        <button class="btn btn-outline-light"
                                type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <!-- Этот блок расположен справа -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" id="top-basket">
                            <a class="nav-link" href="{{ route('basket.index') }}">Корзина @if (!empty($positions))
                                {{ '(' . $positions . ')' }}
                            @endif</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <div class="dropdown show">
                                    <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <x-dropdown-link :href="route('user.index')">
                                            {{ __('Профиль') }}
                                        </x-dropdown-link>
                                        @if (auth()->user()->admin)
                                            <x-dropdown-link :href="route('admin.index')">
                                                {{ __('Админ Панель') }}
                                            </x-dropdown-link>
                                        @endif
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Выйти') }}
                                            </x-dropdown-link>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    
        <div class="row">
            <div class="col-md-3 mt-3">
                <h4>Разделы каталога</h4>
                <div id="catalog-sidebar">
                    <ul>
                        @foreach ($items['rootCategories'] as $category)
                            <li>
                                <a href="{{ route('catalog.category', $category->slug) }}">{{ $category->name }}</a>
                                @include('layouts.part.branch', ['level' => 0])
                            </li>
                        @endforeach
                    </ul>
                </div>
                <h4>Популярные бренды</h4>
                <ul>
                    @foreach ($items['popularBrands'] as $brand)
                        <li>
                            <a href="{{ route('catalog.brand', $brand->slug) }}">{{ $brand->name }}</a>
                            <span class="badge badge-dark float-right">{{ $brand->products_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9 mt-3">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible mt-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>