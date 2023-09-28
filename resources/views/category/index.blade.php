@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <h1 class="text-center">Категории</h1>
        <form method="get" action="{{ route('category.admin.index') }}">
           <div class="input-group mb-3 ">
               <input name="name" class="form-control" placeholder="Поиск по наименованию" id="findButton" aria-label="" type="text">
               <button class="btn btn-outline-primary" type="submit">Найти</button>
           </div>
        </form>
        <div>
            <form method="post" action="{{ route('category.admin.store') }}">
                @csrf
                <div class="input-group mb-3">
                    <input name="name" class="form-control" placeholder="Наименование" id="findButton" aria-label="Наименование категории" type="text" value="{{ old("name") }}"/>
                    <textarea name="description" rows="1" class="form-control" placeholder="Описание категории" aria-label=""></textarea>
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
                                        <input name="category_id" class="visually-hidden" type="text" value="{{ $category->id }}" aria-label="">
                                        <button type="submit" class="btn btn-outline-primary">Посмотреть</button>
                                    </form>
                                @endif
                            @endforeach
                            <hr>
                            <div class="d-flex gap-2">
                                <form action="" method="post">
                                    @csrf
                                    <button class="btn btn-outline-warning" type="submit" href="#">Изменить</button>
                                </form>
                                <form action="{{ route('category.admin.delete', ['id' => $category->id]) }}" method="post">
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
                <p class="p-0 m-0">Требуется добавить категорию! <b>Без категории нельзя создать товар!</b></p>
            </div>
        @endif
    </div>
@endsection

