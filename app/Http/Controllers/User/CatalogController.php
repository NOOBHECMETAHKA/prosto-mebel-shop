<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $photos = Photo::all();

        //Проверка
        $basketCount = null;
        if(!is_null(Auth::user())){
            $basketCount = Basket::countProductsInBasketUser(Auth::user()->getAuthIdentifier());
        }

        return View('storeSystem.catalog', compact('products', 'categories', 'photos', 'basketCount'));
    }

    public function show($id){
        $product = Product::all()->where('id', $id)->first();

        if(!isset($product)){
            redirect()->route('catalog');
        }
        $photos = Photo::all()->where('product_photo_id', $id);

        $category = Category::all()->where('id', $product->category_id)->first();

        //Проверка
        $basketCount = null;
        if(!is_null(Auth::user())){
            $basketCount = Basket::countProductsInBasketUser(Auth::user()->getAuthIdentifier());
        }

        return View('storeSystem.aboutProduct', compact('product', 'category', 'photos', 'basketCount'));
    }

}
