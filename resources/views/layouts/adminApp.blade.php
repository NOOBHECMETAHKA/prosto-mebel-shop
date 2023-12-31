<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Панель администратор</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset("css/bootstrap2.css") }}">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css')}}"/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Просто мебель
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                                </li>
                            @endif
                        @else
                            <div class="dropdown">
                                <button class="btn btn-outline-success-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Данные
                                </button>
                                <ul class="dropdown-menu p-2">
                                    <li class="nav-item">
                                        <a href="{{ route('product.admin.index') }}" class="nav-link">
                                            <img src="{{ asset('Bicons/layout-text-window.svg')}}"> : Продукты</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('category.admin.index') }}" class="nav-link">
                                            <img src="{{ asset('Bicons/layout-text-window.svg')}}"> :
                                            Категории
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('status.admin.index') }}" class="nav-link">
                                            <img src="{{ asset('Bicons/layout-text-window.svg')}}"> :
                                            Статусы
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <img src="{{ asset('Bicons/layout-text-window.svg')}}"> :
                                            Заказы
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <img src="{{ asset('Bicons/layout-text-window.svg')}}"> :
                                            Заявки
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('users.permission.admin.index') }}" class="nav-link">
                                            <img src="{{ asset('Bicons/layout-text-window.svg')}}"> :
                                            Роли
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('users.logs.admin.index') }}" class="nav-link">
                                            <img src="{{ asset('Bicons/code.svg')}}"> :
                                            Консоль
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <li class="nav-item">
                                <a class="nav-link" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('Bicons/emoji-smile.svg')}}"> : {{ Auth::user()->name }} </img>
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-danger" type="submit">Выйти</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
{{--            Контент--}}
        </main>
    </div>
<script src="{{ asset('js/bootstrap2.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script>
    const fileInput = document.getElementById("imagesInput");
    const textTip = document.getElementById("tipText");

    fileInput.addEventListener("change", () => {
       const maxFiles = 3;
       const numFiles = fileInput.files.length;
       if(numFiles > maxFiles){
           fileInput.value = '';
           textTip.style.visibility = 'visible'
       } else {
           textTip.style.visibility = 'hidden'
       }
    });
</script>
</body>
</html>
