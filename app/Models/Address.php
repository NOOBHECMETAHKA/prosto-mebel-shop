<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'addresses';

    public static function show($address){
        return
            'Город '.$address->Сity.
            '; Улица '.$address->Street.
            '; Дом '.$address->House.
            '; Подъезд '.$address->Entrance.
            '; Квартира '.$address->Apartment;
    }
}
