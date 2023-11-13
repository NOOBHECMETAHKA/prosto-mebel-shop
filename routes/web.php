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
Route::get('/catalog/', [App\Http\Controllers\User\CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/product/{id}', [App\Http\Controllers\User\CatalogController::class, 'show'])->where(['id'=>'[0-9]+'])->name('catalog.product.show');
//Функционал корзины
Route::get('/catalog/basket', [App\Http\Controllers\User\BasketController::class, 'index'])->name('catalog.basket.index');
Route::post('/catalog/product/add/{id}', [App\Http\Controllers\User\BasketController::class, 'storeBasket'])->where(['id' => '[0-9]+'])->name('catalog.basket.add');
Route::post('/catalog/product/delete/{id}', [App\Http\Controllers\User\BasketController::class, 'deleteBasket'])->where(['id' => '[0-9]+'])->name('catalog.basket.delete');
Route::post('/catalog/product/clear/', [App\Http\Controllers\User\BasketController::class, 'clearBasket'])->name('catalog.basket.clear');
//Профиль
Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('home.profile');
Route::post('/profile/rename/me', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('home.profile.rename');
//Адреса
Route::get('/profile/address/add', [\App\Http\Controllers\User\AddressController::class, 'add'])->name('profile.address.add');
Route::post('/profile/address/store', [\App\Http\Controllers\User\AddressController::class, 'store'])->name('profile.address.store');
Route::post('/profile/address/delete/{id}', [\App\Http\Controllers\User\AddressController::class, 'delete'])->where(['id' => '[0-9]+'])->name('profile.address.delete');
Route::get('profile/address/edit/{id}', [\App\Http\Controllers\User\AddressController::class, 'edit'])->where(['id' => '[0-9]+'])->name('profile.address.edit');
Route::post('profile/address/update/{id}', [\App\Http\Controllers\User\AddressController::class, 'update'])->where(['id' => '[0-9]+'])->name('profile.address.update');

//Оформление заказа
//Route::post('catalog/basket/')


//Продукты
Route::group(["namespace" => 'Product', 'prefix' => 'admin', 'middleware' => 'admin'], function ($id){
    Route::get('/products', [\App\Http\Controllers\Product\ProductController::class, "index"])->name("product.admin.index");
    Route::get("/add/product", [\App\Http\Controllers\Product\ProductController::class, "add"])->name("product.admin.add");
    Route::get('/products/{id}', [\App\Http\Controllers\Product\ProductController::class, "edit"])->where(['id'=>'[0-9]+'])->name("product.admin.show");

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

Route::group(["namespace" => "Permission", 'prefix' => 'admin', 'middleware' => 'admin'], function ($id){
    Route::get('/users', [\App\Http\Controllers\Permission\PermissionController::class, 'index'])->name('users.permission.admin.index');
});

