<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Магазин'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"><!--Bootstrap v4.4.1-->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-6.7.2-web/css/all.css') }}" /><!--FontAwesome-->
    <link rel="stylesheet" href="{{ asset('plugins\bootstrap-icons-1.11.3\font\bootstrap-icons.css') }}">
    <script src="{{ asset('assets/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- один css-файл -->
    <link href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <!-- два js-скрипта -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ru-RU.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <!-- Бренд и кнопка «Гамбургер» -->
            <a class="navbar-brand" href="{{ route('admin.index') }}">Магазин</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbar-example" aria-controls="navbar-example"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
            <div class="navbar-collapse" id="navbar-example">
                <!-- Этот блок расположен слева -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.order.index') }}">Заказы ({{ $count['orders'] }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.category.index') }}">Категории ({{ $count['categories'] }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.brand.index') }}">Бренды ({{ $count['brands'] }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">Продукты ({{ $count['products'] }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.index') }}">Пользователи ({{ $count['users'] }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.page.index') }}">Страницы ({{ $count['pages'] }})</a>
                    </li>
                </ul>
                <!-- Этот блок расположен справа -->
                <ul class="navbar-nav ml-auto">
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

                                    <x-dropdown-link :href="route('index')">
                                        {{ __('На главную') }}
                                    </x-dropdown-link>

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
        </nav>
        <div class="mt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mt-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible mt-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger col-3">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li class="list-unstyled fw-bold fs-6">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>