<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Просто мебель</title>
    <link rel="stylesheet" href="{{ asset("css/bootstrap2.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
</head>
<body>
<header class="border border-bottom-1">
    <div class="p-1">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 __header_back_links mt-2">
                    <li><a href="/" class="btn btn-light">Главная</a></li>
                    <li><a href="{{ route('catalog') }}" class="btn btn-light">Мебель</a></li>
                    <li><a href="{{ route('home').'#footer' }}" class="btn btn-light">Контакты</a></li>
                </ul>
                <div class="text-end">
                    <ul class="__header_back_links navbar-nav ms-auto mt-2">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a class="btn btn-light" href="{{ route('login') }}">Авторизация</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li>
                                    <a class="btn btn-light" href="{{ route('register') }}">Регистрация</a>
                                </li>
                            @endif
                        @else
                            @if(auth()->user()->role !== 'admin' and isset($basketCount))
                                @if($basketCount != 0)
                                <li>
                                    <a href="{{ route("catalog.basket.index") }}" class="btn btn-outline-dark position-relative">
                                        Корзина
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $basketCount }}
                                        </span>
                                    </a>
                                </li>
                                @endif
                            @endif
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="btn btn-light" href="{{ route('product.admin.index') }}">
                                        <img src="{{ asset('Bicons/card-list.svg')}}" alt=""> : Настройки
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('home.profile') }}" class="btn btn-light" aria-haspopup="true" aria-expanded="false">
                                    Пользователь : {{ Auth::user()->name }} </img>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-light" type="submit">Выйти</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container mt-5">
        @yield('content')
    </div>
</main>
{{--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>--}}
<script src="{{ asset('js/bootstrap2.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>
</html>
