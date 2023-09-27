<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryIndexRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    private function categorySort($data){
        $categories = Category::all();

        if(isset($data['id']))
            $categories = $categories->where('id', $data['id']);
        if(isset($data['title']))
            $categories = $categories->where('title', "{$data['title']}");

        return $categories;
    }

    public function index(CategoryIndexRequest $request){
        $data = $request->validated();

        $categories = $this->categorySort($data);

        $usedCategories = DB::select('SELECT `categories`.`id`, COUNT(`products`.`id`) as `count` FROM `categories` inner join `products` on `categories`.`id` = `products`.`category_id` GROUP by `categories`.`id`');
        return View('category.index', compact('categories', 'usedCategories'));
    }

    public function destroy($id){
        DB::table(Category::$tableName)->where('id', $id)->delete();
        return redirect()->route('category.admin.index');
    }

    public function store(){
        $data = request()->validate(['title' => 'min:3|required|unique:categories']);
        Category::create($data);
        return redirect()->route('category.admin.index');
    }
}
