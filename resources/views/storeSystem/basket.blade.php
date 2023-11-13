@extends('layouts.defaultApp')

@section('content')
    <h1 class="text-center">Корзина</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Цена</th>
            <th scope="col">Сумма</th>
            <th scope="col">Количество</th>
            <th scope="col" colspan="2">Что можно сделать?</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userBasket as $el)
            @foreach($products as $product)
                @if($el->product_basket_id == $product->id)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ round($product->price - \App\Models\Product::getDiscount($product)).' рублей' }}</td>
                        <td>{{ (($product->price - \App\Models\Product::getDiscount($product)) * $el->count_product).' рублей' }}</td>
                        <td>{{ $el->count_product }}</td>
                        <td>
                            <form action="{{ route('catalog.basket.add', ['id'=>$product->id]) }}" method="post">
                                @csrf
                                <button class="btn btn-success" type="submit">Добавить ещё!</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('catalog.basket.delete', ['id'=>$product->id]) }}" method="post">
                                @csrf
                                <button class="btn btn-danger" type="submit">Убрать</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-around align-items-center flex-column">
            <div class="card w-50">
                <div class="card-body">
                    <h5>Выбирете адрес доставки</h5>
                    <select name="" id="" class="form-select" aria-label="Default select">
                        @foreach($addresses as $address)
                            <option value="{{$address->id}}">{{ \App\Models\Address::show($address) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="d-flex justify-content-around align-items-center w-100">
            <div>
                <h3 class="mt-2">Окнончательная цена: {{ $sum }} рублей</h3>
            </div>
            <div class="gap-3 d-flex flex-row">
                <div class="text-end">
                    <form action="{{ route('catalog.basket.clear') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">Почистить корзину</button>
                    </form>
                </div>
                <div class="text-end">
                    <form action="" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">Оформить корзину</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
