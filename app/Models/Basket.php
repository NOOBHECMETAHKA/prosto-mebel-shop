<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Basket extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'baskets';

    public static function addOrUpdateVersionBasket($product_id, $user_id){
        $basket = Basket::all()->where("user_basket_id", $user_id)->where("product_basket_id", $product_id)->first();

        if(!isset($basket)){
            Basket::create([
                "count_product" => 1,
                "user_basket_id" => $user_id,
                "product_basket_id" => $product_id
            ]);
        } else {
            $basket->count_product++;
            $data = $basket->toArray();
            unset($data['id']);
            unset($data['created_at']);
            unset($data['updated_at']);
            DB::table(Basket::$tableName)->where("id", $basket->id)->update($data);
        }
    }

    public static function countProductsInBasketUser($user_id){
        $countProduct = 0;
        foreach(Basket::all()->where("user_basket_id", $user_id) as $product){
            $countProduct += $product->count_product;
        }
        return $countProduct;
    }

}
