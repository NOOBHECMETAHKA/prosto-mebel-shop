@extends('layouts.adminApp')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="#sortModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Сортировка</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="alert alert-primary" role="alert">
                        Сначала выбирите атрибут для сортировки после порядок.
                    </div>
                    <hr>
                    <p>Атрибут</p>
                    <select class="form-select" size="3" aria-label="Size 3 select example">
                        <option selected>Артикул</option>
                        <option value="name">Наименование</option>
                        <option value="description">Описание</option>
                        <option value="price">Стоимость</option>
                        <option value="discount">Скидка</option>
                        <option value="category_id">Тип</option>
                    </select>
                    <hr>
                    <p>Порядок</p>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">По убыванию?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Поехали!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="#filterModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Фильтрация</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Поехали!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-md-column align-items-center">
        <h1 class="text-center m-md-5">Продукты</h1>
        <table class="table">
            <thead>
            <th scope="col">Артикул</th>
            <th scope="col">Наименование</th>
            <th scope="col">Описание</th>
            <th scope="col">Полная стоимость</th>
            <th scope="col">Скидка</th>
            <th scope="col">Тип</th>
            <th scope="col" colspan="2">Функции</th>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name}}</td>
                    <td>{{ mb_substr($product->description, 0, 3, 'UTF-8') }}...</td>
                    <td>
                        <p>{{ round($product->price) }} RUB</p>
                    </td>
                    <td>
                        @if($product->discount != 0)
                            ({{($product->price / 100) * $product->discount}} RUB) {{ round($product->discount) }}%
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @foreach($categories as $category)
                            @if($category->id == $product->category_id)
                                {{ $category->title }}
                            @endif
                        @endforeach
                    </td>
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
        <div class="col">
            <a class="btn btn-outline-success" href="{{ route('product.admin.add') }}">Добавить товар</a>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#sortModal">Сортировка</button>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">Фильтрация</button>
        </div>
    </div>

@endsection
