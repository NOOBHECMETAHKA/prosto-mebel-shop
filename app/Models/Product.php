<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'products';

    public static function getDiscount($product): float|int
    {
        return ($product->price  / 100) * $product->discount;
    }
}
