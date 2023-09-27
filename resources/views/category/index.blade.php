@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <form method="get" action="{{ route('category.admin.index') }}">
           <div class="input-group mb-3 ">
               <input name="title" class="form-control" placeholder="" id="findButton" aria-label="Наименование категории" type="text">
               <button class="btn btn-outline-primary" type="submit">Найти</button>
           </div>
        </form>
        <div>
            <form method="post" action="{{ route('category.admin.store') }}">
                @csrf
                <div class="input-group mb-3">
                    <input name="title" class="form-control" placeholder="" id="findButton" aria-label="Наименование категории" type="text" value="{{ old("name") }}">
                    <button class="btn btn-outline-success" type="submit">Добавить</button>
                </div>
                @error('title')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </form>
        </div>
        <div class="row justify-content-center">
            @foreach($categories as $category)
                <div class="card p-3 col-md-4 m-1 w-25 justify-content-center">
                    <div class="card-body">
                        <h5 class="card-title">{{$category->title}}</h5>
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
    </div>
@endsection

