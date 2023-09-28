<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//Страница вёрствики
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Продукты
Route::group(["namespace" => 'Product', 'prefix' => 'admin', 'middleware' => 'admin'], function ($id){
    Route::get('/products', [\App\Http\Controllers\Product\ProductController::class, "index"])->name("product.admin.index");
    Route::get("/add/product", [\App\Http\Controllers\Product\ProductController::class, "add"])->name("product.admin.add");
    Route::get('/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "show"])->where(['id'=>'[0-9]+'])->name("product.admin.show");

    Route::post("/add/product", [\App\Http\Controllers\Product\ProductController::class, "store"])->name("product.admin.store");
    Route::post('/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "update"])->where(['id'=>'[0-9]+'])->name("product.admin.update");
    Route::post('/delete/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "destroy"])->where(['id'=>'[0-9]+'])->name("product.admin.delete");
});

//Категории
Route::group(["namespace" => "Category", 'prefix' => 'admin', 'middleware' => 'admin'], function ($id){
    Route::get('/categories', [\App\Http\Controllers\Category\CategoryController::class, "index"])->name("category.admin.index");

    Route::post("/add/category", [\App\Http\Controllers\Category\CategoryController::class, "store"])->name("category.admin.store");
    Route::post('/delete/categories/{id}', [\App\Http\Controllers\Category\CategoryController::class, "destroy"])->where(['id'=>'[0-9]+'])->name("category.admin.delete");
    Route::post('/update/categories/{id}', [\App\Http\Controllers\Category\CategoryController::class, "update"])->where(['id'=>'[0-9]+'])->name("category.admin.update");
});

//Статусы
Route::group(["namespace" => "Status", 'prefix' => 'admin', 'middleware' => 'admin'], function ($id){
    Route::get('/statuses', [\App\Http\Controllers\Status\StatusController::class, "index"])->name("status.admin.index");

    Route::post("/add/status", [\App\Http\Controllers\Status\StatusController::class, "store"])->name("status.admin.store");
    Route::post('/delete/statuses/{id}', [\App\Http\Controllers\Status\StatusController::class, "destroy"])->where(['id'=>'[0-9]+'])->name("status.admin.delete");
    Route::post('/update/statuses/{id}', [\App\Http\Controllers\Status\StatusController::class, "update"])->where(['id'=>'[0-9]+'])->name("status.admin.update");
});

