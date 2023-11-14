<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;


class CategoryController extends Controller
{
    private function categoryFilter($data){
        $categories = Category::all();

        if(isset($data['name'])){
            $query = 'select * from `'.Category::$tableName.'` where `name` like \'%'.$data['name'].'%\';';
            $categories = DB::select($query);
        }

        if(isset($data['id']))
            $categories = $categories->where('id', $data['id']);
        return $categories;
    }
    //---------------------------------------Http work
    public function index(CategoryIndexRequest $request){
        $data = $request->validated();

        $categories = count($data) == 0 ? Category::paginate(9) : $this->categoryFilter($data);

        $usedCategories = DB::select('SELECT `categories`.`id`, COUNT(`products`.`id`) as `count` FROM `categories` inner join `products` on `categories`.`id` = `products`.`category_id` GROUP by `categories`.`id`');
        return View('category.index', compact('categories', 'usedCategories'));
    }

    public function destroy($id){
        DB::table(Category::$tableName)->where('id', $id)->delete();
        RedisLogging::saveLog("Удаление", "Категории", Auth::user()->getAuthIdentifier());
        return redirect()->route('category.admin.index');
    }

    public function store(){
        $data = request()->validate(
            [
                'name' => 'min:3|required|unique:categories',
                'description' => ''
            ]);
        Category::create($data);
        RedisLogging::saveLog("Добавление", "Категори", Auth::user()->getAuthIdentifier());
        return redirect()->route('category.admin.index');
    }

    public function update($id){
        $data = request()->validate(
        [
                'name' => 'min:3|required',
                'description' => ''
        ]);

        if(isNull($data['description']))
            $data['description'] = '';

        DB::table(Category::$tableName)->where('id', $id)->update($data);
        RedisLogging::saveLog("Изменение", "Категории", Auth::user()->getAuthIdentifier());
        return redirect()->route('category.admin.index');
    }
}
