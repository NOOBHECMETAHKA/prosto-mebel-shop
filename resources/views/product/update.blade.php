@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <div class="alert alert-warning alert-dismissible fade show m-lg-1" role="alert">
            В случае обновления фотографий старые удалятся!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
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
                <textarea name="description" id="Description-product" rows="3"
                          class="form-control">{{ trim($prod->description) }}</textarea>
                @error("description")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="md-3">
                <label for="Category-product" class="form-label">Категория</label>
                <select name="category_id" id="Category-product" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if($prod->category_id == $category->id) selected @endif>{{ $category->name }}</option>
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
                <input name="discount" id="Discount-product" type="number" value="{{ $prod->discount }}"
                       class="form-control">
                @error("discount")
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="border border-2 rounded mt-3">
                @foreach($photos as $photo)
                    @if($photo->product_photo_id == $prod->id)
                        <img class="m-1" style="height: 100px" src="{{ asset('storage\\'.$photo->link) }}"
                             alt="Продукт">
                    @endif
                @endforeach
            </div>
            <div class="md-3">
                <label for="imagesInput" class="form-label">Выберите изображения</label>
                <input class="form-control" id="imagesInput" type="file" name="image[]" accept="image/*" multiple>
                <div id="tipText" class="mt-2" style="visibility: collapse">
                    <p class="text-danger">Количество файлов ограничено не более 3 фотографий</p>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-outline-success w-25">Обновить товар</button>
            </div>
        </form>
    </div>
@endsection
