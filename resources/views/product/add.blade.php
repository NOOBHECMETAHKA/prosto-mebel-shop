@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <form action="{{ route('product.admin.store') }}" method="post">
            @csrf
            <h1 class="text-center m-md-5">Добавление товара</h1>
            <div class="md-3">
                <label for="Name-Category" class="form-label">Наименование</label>
                <input name="name" id="Name-Category" type="text" value="{{ old("name") }}" class="form-control">
            </div>
            <div class="md-3">
                <label for="Description-product" class="form-label">Описание</label>
                <textarea name="description" id="Description-product" rows="3" class="form-control">{{ old("description") }}</textarea>
                @error("description")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="md-3">
                <label for="Category-product" class="form-label">Категория</label>
                <select name="category_id" id="Category-product" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
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
            <div class="d-flex justify-content-center p-5">
                <button type="submit" class="btn btn-outline-success w-25 m-md-5">Добавить товар</button>
            </div>
        </form>
    </div>
@endsection
