@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <form action="{{ route('product.admin.update', ['id' => $prod->id]) }}" method="post">
            @csrf
            <h1 class="text-center">Изменение товара</h1>
            <h5 class="text-center">Артикул товара: {{ $prod->id }}</h5>
            <div class="md-3">
                <label for="Name-product" class="form-label">Наименование</label>
                <input name="name" id="Name-product" type="text" value="{{ $prod->name }}" class="form-control">
                @error("name")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="md-3">
                <label for="Description-product" class="form-label">Описание</label>
                <textarea name="description" id="Description-product" rows="3" class="form-control">{{ trim($prod->description) }}</textarea>
                @error("description")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="md-3">
                <label for="Category-product" class="form-label">Категория</label>
                <select name="category_id" id="Category-product" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($prod->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error("category_id")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="md-3">
                <label for="Price-product" class="form-label">Цена</label>
                <input name="price" id="Price-product" type="number" value="{{ $prod->price }}" class="form-control">
                @error("price")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="md-3">
                <label for="Discount-product" class="form-label">Скидка</label>
                <input name="discount" id="Discount-product" type="number" value="{{ $prod->discount }}" class="form-control">
                @error("discount")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="d-flex justify-content-center p-5">
                <button type="submit" class="btn btn-outline-success w-25">Обновить товар</button>
            </div>
        </form>
    </div>
@endsection
