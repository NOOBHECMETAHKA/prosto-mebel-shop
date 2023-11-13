<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Мебельный магазин</title>
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
</head>
<body>
<header class="__header_block" id="header_links">
    <div class="pt-1">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 __header_back_links">
                    <li><a href="/" class="btn btn-light">Главная</a></li>
                    <li><a href="{{ route('catalog') }}" class="btn btn-light">Мебель</a></li>
                    <li><a href="#footer" class="btn btn-light">Контакты</a></li>
                </ul>
                <div class="text-end">
                    <ul class="__header_back_links navbar-nav ms-auto">
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
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="btn btn-light" href="{{ route('product.admin.index') }}">
                                        <img src="{{ asset('Bicons/card-list.svg')}}"> : Настройки
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="btn btn-light" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('Bicons/emoji-smile.svg')}}"> : {{ Auth::user()->name }} </img>
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

            <div class="__header_content d-flex justify-content-center">
                <div class="__header_sub_content">
                    <h4 class="text-white text-center">Соверменная мебель</h4>
                    <div class="d-flex justify-content-center">
                        <div class="__header_under_line"></div>
                    </div>
                    <h1 class="text-white text-center mt-3"><span>Детская мебель на заказ</span><br>от фабрики детской
                        мебели</h1>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="__header_bottom_line"></div>
<main>
    <div class="container" id="projects">
        <section>
            <div class="__individual_projects mt-5">
                <h1 class="text-center">Наши индивидуальные проекты</h1>
                <div class="d-flex justify-content-center">
                    <h3>⩶⩶⩶⩶⩶</h3>
                </div>
                <h3 class="text-center">Мы <span>ищем вдохновение</span> в ваших словах и мыслях для вложения их в
                    наши<br> чертежи и проекты.</h3>
            </div>
            <div class="mt-5">
                <img class="__individual_projects_image rounded" src="{{ asset('img/content-picture_2.jpg')}}"
                     alt="Мебельный проект">
            </div>
            <div class="__individual_projects mt-5">
                <h3 class="text-center">Собираем множество концепций и выделяем самые <span>интересные детали.</span>
                </h3>
            </div>
            <div class="mt-5">
                <img class="__individual_projects_image rounded" src="{{ asset('img/content-picture_3.jpg')}}"
                     alt="Мебельный проект">
            </div>
        </section>
    </div>

    <div id="production" class="__about_production-content_block mt-5">
        <div class="__about_production-content_block-first d-flex justify-content-center">
            <h1 class="text-center">Собственноe<br>производство</h1>
            <div class="mt-5">
                <p class="text-start">Наше производство оснащено лучшим оборудованием для производства детской
                    мебели.</p>
            </div>
        </div>
        <div class="__about_production-content_block-second container __about_production_image_background d-flex justify-content-center m-0 p-0">
            <div class="m-0">
                <h3 class="text-center mt-5">Производство ручной работы</h3>
                <p class="text-center"><></p>
            </div>
        </div>
    </div>

    <div class="container mt-5" id="recommendations">
        <section>
            <div class="__recommendations_content">
                <div class="__recommendations_content-main-block w-75">
                    <p class="__recommendations_content_block-title text-center">Мы гарантируем</p>
                    <p class="__recommendations_content_block-description text-center">Исполнение желаний, а так же:</p>
                    <div class="__recommendations_content_blocks p-3">
                        <div>
                            <img src="{{ asset("svg/chat.svg") }}" alt="">
                            <p class="__recommendations_content_block-title">Помощь клиентам</p>
                            <p class="__recommendations_content_block-description mt-3">Поможем разобраться и подобрать
                                мебель, цвета, а также нарисуем дизайн проект.</p>
                        </div>
                        <div>
                            <img src="{{ asset("svg/award-fill.svg") }}" alt="">
                            <p class="__recommendations_content_block-title">Высокое качество</p>
                            <p class="__recommendations_content_block-description mt-3">Создаем и реализовываем проекты
                                и мебель только высокого и лучшего качества.</p>
                        </div>
                        <div>
                            <img src="{{ asset("svg/eco.svg") }}" alt="">
                            <p class="__recommendations_content_block-title">Эко-материалы</p>
                            <p class="__recommendations_content_block-description mt-3">Производим мебель и проекты из
                                экологически чистых и качественных материалов.</p>
                        </div>
                        <div>
                            <img src="{{ asset("svg/idea.svg") }}" alt="">
                            <p class="__recommendations_content_block-title">Любая сложность</p>
                            <p class="__recommendations_content_block-description mt-3">Гарантируем, что произведем и
                                спроектируем мебель и ваши проекты любой сложности.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <p class="__recommendations_content-title text-center">Мы работаем с 2014 года
                        более<br><span>10,000</span></p>
                    <p class="__recommendations_content-span text-center">выполненных работ</p>
                </div>
            </div>
        </section>

    </div>
</main>
<footer class="mt-5" id="footer">
    <div class="container">
        <div class="__footer_content pt-5 row g-3">
            <div class="__footer_block_content col-md-4">
                <p class="__footer_block_content-title m-0">Социальные сети</p>
                <ul>
                    <li>
                        <img src="{{ asset('svg/whatsapp.svg') }}" alt="">
                        <a href="#" class="__footer_block_content-description m-0">Whatsapp</a>
                    </li>
                    <li>
                        <img src="{{ asset('svg/instagram.svg') }}" alt="">
                        <a href="#" class="__footer_block_content-description m-0">Instagram</a>
                    </li>
                    <li>
                        <img src="{{ asset('svg/facebook.svg') }}" alt="">
                        <a href="#" class="__footer_block_content-description m-0">Facebook</a>
                    </li>
                    <li>
                        <img src="{{ asset('svg/messenger.svg') }}" alt="">
                        <a href="#" class="__footer_block_content-description m-0">ВКонтакте</a>
                    </li>
                </ul>
            </div>
            <div class="__footer_block_content col-md-4">
                <p class="__footer_block_content-title m-0">О нас</p>
                <ul>
                    <li>
                        <a href="#header_links" class="__footer_block_content-description m-0"><span>#</span> Главная</a>
                    </li>
                    <li>
                        <a href="#production" class="__footer_block_content-description m-0"><span>#</span> Производство</a>
                    </li>
                    <li>
                        <a href="#recommendations" class="__footer_block_content-description m-0"><span>#</span> Преимущества</a>
                    </li>
                    <li>
                        <a href="#projects" class="__footer_block_content-description m-0"><span>#</span> Проекты</a>
                    </li>
                </ul>
            </div>
            <div class="__footer_block_content col-md-4">
                <p class="__footer_block_content-title m-0">Номер телефона</p>
                <ul>
                    <li>
                        <a href="#" class="__footer_block_content-description m-0">+X(XXX)XXX-XX-XXX</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/bootstrap2.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>
</html>
