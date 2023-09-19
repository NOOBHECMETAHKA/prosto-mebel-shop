@extends('layouts.adminApp')

@section('content')
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
            <th scope="col">Функции</th>
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
                        ({{($product->price / 100) * $product->discount}} RUB) {{ round($product->discount) }}%
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
                        <a class="btn btn-outline-danger" href="{{ route('product.admin.delete', ['id' => $product->id]) }}">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-outline-success w-25" href="{{ route('product.admin.add') }}">Добавить товар</a>
    </div>
@endsection
