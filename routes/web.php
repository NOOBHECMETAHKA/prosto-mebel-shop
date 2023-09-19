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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["namespace" => 'Product', 'prefix' => 'admin', 'middleware' => 'admin'], function ($id){
    Route::get('/products', [\App\Http\Controllers\Product\ProductController::class, "index"])->name("product.admin.index");
    Route::get("/add/product", [\App\Http\Controllers\Product\ProductController::class, "add"])->name("product.admin.add");
    Route::get('/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "show"])->where(['id'=>'[0-9]+'])->name("product.admin.show");

    Route::post("/add/product", [\App\Http\Controllers\Product\ProductController::class, "store"])->name("product.admin.store");
    Route::post('/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "update"])->where(['id'=>'[0-9]+'])->name("product.admin.update");
    Route::delete('/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "destroy"])->where(['id'=>'[0-9]+'])->name("product.admin.delete");
});