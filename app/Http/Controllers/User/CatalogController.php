<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderList;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $photos = Photo::all();

        return View('storeSystem.catalog', compact('products', 'categories', 'photos'));
    }

    public function show($id){
        $product = Product::all()->where('id', $id)->first();

        if(!isset($product)){
            redirect()->route('catalog');
        }
        $photos = Photo::all()->where('product_photo_id', $id);

        $category = Category::all()->where('id', $product->category_id)->first();

        return View('storeSystem.aboutProduct', compact('product', 'category', 'photos'));
    }
}
