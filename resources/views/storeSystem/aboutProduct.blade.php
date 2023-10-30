@extends('layouts.defaultApp')

@section('content')
    <div class="__catalog_block_show d-flex align-items-center flex-column">
        <h1 class="text-center">{{ $product->name }}</h1>
        @if(count($photos) != 0)
            <div class="__catalog_show_block_collection_images w-50 p-3 gap-3 d-flex justify-content-around">
                @foreach($photos as $photo)
                    <img src="{{ asset("storage/".$photo->link) }}" class="__catalog_show_block_images" alt="">
                @endforeach
            </div>
        @endif
        <table class="table w-75 mt-5">
            <thead>
            <tr>
                <th class="">Заголовок</th>
                <th class="">Содержание</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="">Описание:</td>
                <td class="text-start">{{ $product->description }}</td>
            </tr>
            <tr>
                <td class="">Цена:</td>
                <td class="text-start">{{ $product->price.' рублей' }}</td>
            </tr>
            <tr>
                <td class="">Скидка:</td>
                <td class="text-start">{{ $product->getDiscount($product).' рублей' }}</td>
            </tr>
            <tr>
                <td class="">Категория:</td>
                <td class="text-start">{{ $category->name }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
