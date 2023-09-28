<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    private function productSortFilter($data){
        $products = Product::all();



        //Сортировка
        if(isset($data["argument"])){
            if(isset($data['sortMode']))
                $products = $products->sortBy($data['argument'])->reverse();
            else
                $products = $products->sortBy($data['argument']);
        }

        //Фильтрация
        $collection = ['id', 'name', 'price', 'discount', 'category_id', 'importance_rating'];

        foreach($collection as $filterElement){
            if(isset($data[$filterElement]))
                $products = $products->where($filterElement, $data[$filterElement]);
        }

//        //Фильтрация с вкладки категории
//        if(isset($data['category_id']))
//            $products = $products->where('category_id', $data['category_id']);

        return $products;
    }

    //---------------------------------------Http work

    public function index(ProductIndexRequest $request){
        $data = $request->validated();

        $products = $this->productSortFilter($data);

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
                'discount' => 'numeric|min:0',
                'importance_rating' => 'numeric|min:0',
                'image' => ''
            ]
        );

        dd($data);
        DB::table(Product::$tableName)->where('id', $id)->update($data);
        return redirect()->route('product.admin.index');
    }

    public function store(){
       $data = request()->validate(
           [
               'name' => 'string|min:3|required|unique:products',
               'description' => 'string',
               'price' => 'numeric|min:0',
               'category_id' => 'numeric|min:0',
               'discount' => 'numeric|min:0',
               'importance_rating' => 'numeric|min:0',
               'image' => ''
           ]
       );

       $path = Storage::disk('public')->put('/images', $data['image']);
       dd($path);
       DB::table("products")->insert($data);
       return redirect()->route('product.admin.index');
    }

    public function destroy($id){
        DB::table(Product::$tableName)->where('id', $id)->delete();
        return redirect()->route('product.admin.index');
    }
}
