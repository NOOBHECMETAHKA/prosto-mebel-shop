<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        $userBasket = Basket::all()->where('user_basket_id', Auth::user()->getAuthIdentifier());
        if(count($userBasket) == 0){
            return redirect()->route('catalog');
        }
        $basketCount = Basket::countProductsInBasketUser(Auth::user()->getAuthIdentifier());
        $products = Product::all();
        $addresses = Address::all()->where('user_addresses_id', Auth::user()->getAuthIdentifier());

        $sum = 0;
        foreach($userBasket as $el){
            foreach($products as $product){
                if($el->product_basket_id == $product->id){
                    $sum += ($product->price - Product::getDiscount($product)) * $el->count_product;
                }
            }
        }

        return View('storeSystem.basket', compact('userBasket', 'basketCount', 'products', 'sum', 'addresses'));
    }

    public function storeBasket($id){

        $user_id = Auth::user()->getAuthIdentifier();
        Basket::addOrUpdateVersionBasket($id, $user_id);
        return redirect()->route('catalog');
    }

    public function deleteBasket($id){
        $user_id = Auth::user()->getAuthIdentifier();
        DB::table(Basket::$tableName)->where("product_basket_id", $id)->where('user_basket_id', $user_id)->delete();
        return redirect()->route('catalog');
    }

    public function clearBasket(){
        $user_id = Auth::user()->getAuthIdentifier();
        DB::table(Basket::$tableName)->where('user_basket_id', $user_id)->delete();
        return redirect()->route('catalog');
    }
}
