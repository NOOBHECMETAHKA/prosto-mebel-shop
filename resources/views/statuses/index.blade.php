@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center">Статусы</h1>
        <form method="get" action="">
            <div class="input-group mb-3 ">
                <input name="name" class="form-control" placeholder="Поиск по наименованию" id="findButton"
                       aria-label="" type="text">
                <button class="btn btn-outline-primary" type="submit">Найти</button>
            </div>
        </form>
{{--        <div>--}}
{{--            Добавление статуса--}}
{{--            <form method="post" action="{{ route('status.admin.store') }}">--}}
{{--                @csrf--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <input name="name" class="form-control" placeholder="Наименование" id="findButton"--}}
{{--                           aria-label="Наименование категории" type="text" value="{{ old("name") }}"/>--}}
{{--                    <textarea name="description" rows="1" class="form-control" placeholder="Описание категории"--}}
{{--                              aria-label="" required></textarea>--}}
{{--                    <button class="btn btn-outline-success" type="submit">Добавить</button>--}}
{{--                </div>--}}
{{--                @error('name')--}}
{{--                <div class="alert alert-danger" role="alert">--}}
{{--                    {{ $message }}--}}
{{--                </div>--}}
{{--                @enderror--}}
{{--                @error('description')--}}
{{--                <div class="alert alert-danger" role="alert">--}}
{{--                    {{ $message }}--}}
{{--                </div>--}}
{{--                @enderror--}}
{{--            </form>--}}
{{--        </div>--}}
        @if(count($statuses) != 0)
            <div class="row justify-content-center flex-wrap">
                @foreach($statuses as $status)
                    <div class="card p-3 col-md-4 m-1 w-25 justify-content-center">
                        <div class="card-body">
                            <h5 class="card-title
                            @if($status->is_deleted == 1)
                            text-decoration-line-through
                            @endif"
                            >{{$status->name}}</h5>
                            <hr>
                            <p>{{$status->description}}</p>
                            <hr>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#updateModal-{{$status->id}}">Изменить
                                </button>
                                <form action="{{ route('status.admin.update', ['id' => $status->id]) }}"
                                      method="post">
                                    @csrf
                                    <div class="modal fade" id="updateModal-{{$status->id}}" tabindex="-1"
                                         aria-labelledby="#updateModal-{{$status->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Изменение категории</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3 form-check">
                                                        <label class="form-check-label"
                                                               for="name">Наименование</label>
                                                        <input name="name" id="name" type="text"
                                                               class="form-control" value="{{ $status->name }}">
                                                    </div>
                                                    <div class="mb-3 form-check">
                                                        <label class="form-check-label"
                                                               for="description">Описание</label>
                                                        <input name="description" id="description" type="text"
                                                               class="form-control"
                                                               value="{{ $status->description }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Закрыть
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Изменить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('status.admin.delete', ['id' => $status->id]) }}"
                                      method="post">
                                    @csrf
                                    @if($status->is_deleted == 0)
                                        <button class="btn btn-outline-danger" type="submit">Не использовать</button>
                                    @else
                                        <button class="btn btn-outline-success" type="submit">Использовать</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning justify-content-center" role="alert">
                <p class="p-0 m-0">Пусто</p>
            </div>
        @endif
    </div>
@endsection

