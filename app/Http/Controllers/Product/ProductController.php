<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\ImageManager;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;


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

        return $products;
    }

    //---------------------------------------Http work

    public function index(ProductIndexRequest $request){
        $data = $request->validated();

        $products = $this->productSortFilter($data);

        $categories = Category::all();
        $images = Photo::all();
        return View('product.index', compact('products', 'categories', 'images'));
    }

    public function add(){
        $categories = Category::all();
        return View('product.add', compact('categories'));
    }

    public function edit($id){
        $prod = Product::all()->where("id", $id)->first();
        if($prod == null)
            return redirect()->route("product.admin.index");
        $categories = Category::all();

        $photos = Photo::all();

        return View('product.update', compact('prod', 'categories', 'photos'));
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

       //Функция принимает коллексицию данных подходящую для обработки и добавления
        //Мы удаляем поле для объекта, чтобы он подходил для валидации
        //После коллекцией файлов связываем файл с ключом в массив и эту структуру отправляем, с помощью Entity insert
       $infoInject = $data['image'];
       unset($data['image']);

       $insertedID = DB::table(Product::$tableName)->insertGetId($data);

       $photoObject = [];
       foreach ($infoInject as $photo){
           $path = ImageManager::save($photo);
           $photoObject[] = ['product_photo_id' => $insertedID, 'link' => $path];
       }

       Photo::insert($photoObject);

       return redirect()->route('product.admin.index');
    }

    public function destroy($id){

        dd($id);
        $photos = Photo::all()->where("product_photo_id", $id);
        $collection_ids_photos = [];

        foreach ($photos as $photo){
            $collection_ids_photos[] = $photo->id;
        }

        DB::table(Photo::$tableName)->delete($collection_ids_photos);

        DB::table(Product::$tableName)->where('id', $id)->delete();
        return redirect()->route('product.admin.index');
    }
}
