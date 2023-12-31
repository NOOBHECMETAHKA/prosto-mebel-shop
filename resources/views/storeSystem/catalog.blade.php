@extends('layouts.defaultApp')

@section('content')
    <div class="__catalog_block__list justify-content-center">
        @foreach($products as $product)
            <div class="__catalog_block w-75">
                <div class="">
                    <img
                        @foreach($photos as $photo)
                            @if($product->id == $photo->product_photo_id)
                                src="{{ asset("storage/$photo->link") }}"
                            @break
                            @endif
                        @endforeach
                        class="__catalog_block_img" alt="">
                </div>
                <ul class="list-group list-group-flush d-flex">
                    <li class="list-group-item"><h4>{{ $product->name }}</h4></li>
                    <li class="list-group-item">
                        @if($product->discount != 0)
                            <span class="text-decoration-line-through">{{ round($product->price).' рублей' }}</span>
                            <br>
                            <span>{{ ($product->price - $product->getDiscount($product)).' рублей' }}</span>
                        @else
                            <span>{{ round($product->price).' рублей' }}</span>
                        @endif
                    </li>
                </ul>
                <div class="p-3 __catalog_block_links">
                    <form action="{{ route('catalog.basket.add', ['id'=>$product->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="__catalog_block_button p-3 bg-white">В корзину</button>
                        <a href="{{ route("catalog.product.show", ['id'=>$product->id]) }}" class="__catalog_block_button p-3">Подробнее</a>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
