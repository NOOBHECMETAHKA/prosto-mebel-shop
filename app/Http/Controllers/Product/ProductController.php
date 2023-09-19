<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return View('product.index', compact('products', 'categories'));
    }

    public function add(){
        $categories = Category::all();
        return View('product.add', compact('categories'));
    }

    public function show($id){
        $prod = Product::all()->where("id", $id)->first();
        if($prod == null)
            return redirect()->route("product.admin.index");
        $categories = Category::all();
        return View('product.update', compact('prod', 'categories'));
    }

    public function update($id){
        $data = request()->validate(
            [
                'name' => 'string|min:3|required',
                'description' => 'string',
                'price' => 'numeric|min:0',
                'category_id' => 'numeric|min:0',
                'discount' => 'numeric|min:0'
            ]
        );
        DB::table("products")->where('id', $id)->update($data);
        return redirect()->route('product.admin.index');
    }

    public function store(){
       $data = request()->validate(
           [
               'name' => 'string|min:3|required|unique:products',
               'description' => 'string',
               'price' => 'numeric|min:0',
               'category_id' => 'numeric|min:0',
               'discount' => 'numeric|min:0'
           ]
       );
       DB::table("products")->insert($data);
       return redirect()->route('product.admin.index');
    }

    public function destroy($id){
        DB::table("products")->where('id', $id)->delete();
    }
}