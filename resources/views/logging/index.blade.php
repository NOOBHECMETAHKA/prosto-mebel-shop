@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center w-100">
            <h3 class="text-center"></h3>
            <div style="height: 400px" class="p-2 border rounded-1 w-100 bg-dark d-flex flex-column __console_block">
                <div class="w-100 d-flex justify-content-between p-lg-1 flex-row p-0 m-0 align-items-center">
                    <h3 class="text-light"><span class="text-danger fw-bold fs-3">#</span> Консоль</h3>
                    <div class="d-flex flex-row gap-3">
                        <form action="{{ route('users.logs.admin.clear') }}" method="post">
                            @csrf
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
                <div class="p-1 overflow-y-scroll h-100 w-100">
                    @foreach($logs as $log)
                        <p class="text-light m-0"><span class="fw-bold">{{ $log->timing }} |</span> {{ $log->message }}<span class="text-danger text-red"> пользователем: {{ $users->where('id', $log->user_id)->first()->email }}</span> </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card w-75">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h3><span class="text-danger fw-bold fs-3">#</span> Импорт и экспорт данных</h3>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Продукты</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="product-radio" autocomplete="off" checked>
                            <label class="btn" for="product-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Категории</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="category-radio" autocomplete="off" checked>
                            <label class="btn" for="category-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Статусы</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="status-radio" autocomplete="off" checked>
                            <label class="btn" for="status-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Заявки</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="application-radio" autocomplete="off" checked>
                            <label class="btn" for="application-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Заказы</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="order-radio" autocomplete="off" checked>
                            <label class="btn" for="order-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Персонал</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="personal-radio" autocomplete="off" checked>
                            <label class="btn" for="personal-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <p class="fs-5 fw-bold m-0 p-0">Адреса</p>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="address-radio" autocomplete="off" checked>
                            <label class="btn" for="address-radio">Выбрать</label>
                        </div>
                    </div>
                </li>

                <li class="list-group-item mt-5">
                    <div class="w-100 d-flex flex-row justify-content-between align-items-center">
                        <div class="d-flex flex-row gap-3 w-50">
                            <p class="fs-5 fw-bold m-0 p-0">Тип файла: </p>
                            <select class="form-select w-50" name="type_file" id="" aria-label="">
                                <option value="sql">SQL</option>
                                <option value="cvs">CVS</option>
                            </select>
                        </div>
                        <div class="d-flex flex-row gap-3">
                            <form action="">
                                @csrf
                                <button class="btn btn-outline-dark" type="submit">Импорт</button>
                            </form>
                            <form action="">
                                @csrf
                                <button class="btn btn-outline-dark" type="submit">Экспорт</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <script>
            var = document.getElementById('');
        </script>
    </div>

@endsection
