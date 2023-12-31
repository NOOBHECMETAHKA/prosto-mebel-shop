@extends('layouts.adminApp')

@section('content')
{{--Сортировка--}}
    <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="#sortModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('product.admin.index') }}" method="get">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Сортировка</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <div class="alert alert-primary" role="alert">
                            Сначала выбирите атрибут для сортировки после порядок.
                        </div>
                        <hr>
                        <p>Атрибут</p>
                        <select name="argument" class="form-select" size="3" aria-label="">
                            <option value="id" selected>Артикул</option>
                            <option value="name">Наименование</option>
                            <option value="price">Стоимость</option>
                            <option value="discount">Скидка</option>
                            <option value="importance_rating">Важность</option>
                        </select>
                        <hr>
                        <p>Порядок</p>
                        <div class="mb-3 form-check">
                            <input name="sortMode" id="checkModeSort" type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="checkModeSort">По убыванию?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Поехали!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--Фильтрация--}}
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="#filterModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Фильтрация</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <form action="{{ route('product.admin.index') }}" method="get">
                        @csrf
                        <div class="md-3">
                            <label for="ID" class="form-label">Артикул</label>
                            <input name="id" id="ID" type="text" value="{{ old("name") }}" class="form-control">
                        </div>
                        <div class="md-3">
                            <label for="Name-Category" class="form-label">Наименование</label>
                            <input name="name" id="Name-Category" type="text" value="{{ old("name") }}" class="form-control">
                        </div>
                        <div class="md-3">
                            <label for="Category-product" class="form-label">Категория</label>
                            <select name="category_id" id="Category-product" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="" selected>Ничего</option>
                            </select>
                            @error("category_id")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md-3">
                            <label for="Price-product" class="form-label">Цена</label>
                            <input name="price" id="Price-product" type="number" value="{{ old("price") }}" class="form-control">
                            @error("price")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md-3">
                            <label for="Discount-product" class="form-label">Скидка</label>
                            <input name="discount" id="Discount-product" type="number" value="{{ old("discount") }}" class="form-control">
                            @error("discount")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md-3">
                            <label for="Importance_rating" class="form-label">Важность</label>
                            <input name="importance_rating" id="Importance_rating" type="number" min="0" max="5" value="{{ old("discount") }}" class="form-control">
                            @error("importance_rating")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Поехали!</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-flex flex-md-column align-items-center">
        <h1 class="text-center">Продукты</h1>
        <table class="table">
            <thead>
            <th scope="col">Артикул</th>
            <th scope="col">Наименование</th>
            <th scope="col">Описание</th>
            <th scope="col">Полная стоимость</th>
            <th scope="col">Скидка</th>
            <th scope="col">Тип</th>
            <th scope="col">Важность</th>
            <th scope="col" colspan="2">Функции</th>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td><div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $product->id }}
                            </a>
                            <div class="dropdown-menu p-2">
                                <p><b>Описание:</b> {{$product->description}}</p>
                                @foreach($images as $image)
                                    @if($image->product_photo_id == $product->id)
                                        <img class="w-25 border" src="{{ asset('storage\\'.$image->link) }}" alt="Продукт">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </td>
                    {{--Артикул--}}
                    <td>{{ $product->name}}</td>
                    {{--Наименование--}}
                    <td>{{ mb_substr($product->description, 0, 3, 'UTF-8') }}...</td>
                    {{--Описание--}}
                    <td>
                        <p>{{ round($product->price) }} RUB</p>
                    </td>
                    {{--Цена--}}
                    <td>
                        @if($product->discount != 0)
                            ({{($product->price / 100) * $product->discount}} RUB) {{ round($product->discount) }}%
                        @else
                            -
                        @endif
                    </td>
                    {{--Скидка--}}
                    <td>
                        @foreach($categories as $category)
                            @if($category->id == $product->category_id)
                                {{ $category->name }}
                            @endif
                        @endforeach
                    </td>
                    {{--Категория--}}
                    <td>{{ $product->importance_rating}}</td>
                    {{--Важность--}}
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('product.admin.show', ['id' => $product->id]) }}">Изменить</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('product.admin.delete', ['id' => $product->id]) }}">
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($products) != 0)
            <div class="col">
                <a class="btn btn-outline-success" href="{{ route('product.admin.add') }}">Добавить товар</a>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#sortModal">Сортировка</button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">Фильтрация</button>
            </div>
        @else
            @if(count($categories) != 0)
                <div class="col">
                    <h3 class="text-center">Товаров нету!</h3>
                    <a class="btn btn-outline-success" href="{{ route('product.admin.add') }}">Добавить товар</a>
                </div>
            @else
                <div class="alert alert-warning justify-content-center" role="alert">
                    <p class="p-0 m-0">Для добавления товаров перейдите во вкладку категория и добавте хотя бы 1 категорию.</p>
                </div>
            @endif
        @endif
    </div>

@endsection
