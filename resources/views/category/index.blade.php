@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center">Категории</h1>
        <form method="get" action="{{ route('category.admin.index') }}">
            <div class="input-group mb-3 ">
                <input name="name" class="form-control" placeholder="Поиск по наименованию" id="findButton"
                       aria-label="" type="text">
                <button class="btn btn-outline-primary" type="submit">Найти</button>
            </div>
        </form>
        <div>
            <form method="post" action="{{ route('category.admin.store') }}">
                @csrf
                <div class="input-group mb-3">
                    <input name="name" class="form-control" placeholder="Наименование" id="findButton"
                           aria-label="Наименование категории" type="text" value="{{ old("name") }}"/>
                    <textarea name="description" rows="1" class="form-control" placeholder="Описание категории"
                              aria-label="" required></textarea>
                    <button class="btn btn-outline-success" type="submit">Добавить</button>
                </div>
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
                @error('description')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </form>
        </div>
        @if(count($categories) != 0)
            <div class="row justify-content-center">
                @foreach($categories as $category)
                    <div class="card p-3 col-md-4 m-1 w-25 justify-content-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$category->name}}</h5>
                            @foreach($usedCategories as $key)
                                @if($category->id == $key->id)
                                    <hr>
                                    <p class="card-text">Количество товаров: {{ $key->count }}</p>
                                    <form action="{{ route('product.admin.index') }}" method="get">
                                        <input name="category_id" class="visually-hidden" type="text"
                                               value="{{ $category->id }}" aria-label="">
                                        <button type="submit" class="btn btn-outline-primary">Посмотреть</button>
                                    </form>
                                @endif
                            @endforeach
                            <hr>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#updateModal-{{$category->id}}">Изменить
                                </button>
                                <form action="{{ route('category.admin.update', ['id' => $category->id]) }}"
                                      method="post">
                                    @csrf
                                    <div class="modal fade" id="updateModal-{{$category->id}}" tabindex="-1"
                                         aria-labelledby="#updateModal-{{$category->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Изменение категории</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal- p-1">
                                                    <form action="" method="post">
                                                        <div class="mb-3 form-check">
                                                            <label class="form-check-label"
                                                                   for="name">Наименование</label>
                                                            <input name="name" id="name" type="text"
                                                                   class="form-control" value="{{ $category->name }}">
                                                        </div>
                                                        <div class="mb-3 form-check">
                                                            <label class="form-check-label"
                                                                   for="description">Описание</label>
                                                            <input name="description" id="description" type="text"
                                                                   class="form-control"
                                                                   value="{{ $category->description }}">
                                                        </div>
                                                    </form>
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
                                <form action="{{ route('category.admin.delete', ['id' => $category->id]) }}"
                                      method="post">
                                    @csrf
                                    <button class="btn btn-outline-danger" type="submit" href="#">Удалить</button>
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

