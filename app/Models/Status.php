<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;

    protected $guarded = false;
    public static $tableName = 'statuses';


    public static function firstValues()
    {
        $data = [
            'under_consideration' => ['В рассмотрении', 'Заказ оформлен и в скором времени мы с вами свяжемся'],
            'waiting_for_payment' => ['В ожидании оплаты', 'Заказ требуется оплатить по ранее установленным контактам'],
            'canceled' => ['Отменён', 'Заказ отменён. Если возникли вопросы обратитесь к администрации!'],
            'delivered_for_delivery' => ['Передан в доставку', 'Заказ передан в доставку и в скором времени прибудет в место назначения!'],
            'in_stock' => ['На складе', 'Заказ хранится на складе организации'],
            'lost' => ['Утерян', 'Ваш заказ утерян! Мы разбираемся в чём причина!'],
            'destroyed' => ['Уничтожен', 'Ваш заказ уничтожен!']
        ];

        $statues = [];
        foreach ($data as $key => $info) {
            $statues[] =
                [
                    'key_value' => $key,
                    'name' => $info[0],
                    'description' => $info[1],
                ];
        }
        return $statues;
    }

    public static function getStatus($str)
    {
        return Status::all()->where('key_value', $str)->first();
    }

    public static function logicDelete($id)
    {
        $data = Status::all()->where('id', $id)->first();
        if ($data != null) {
            $value = $data->is_deleted == 0 ? 1 : 0;
            $delete_status = ['is_deleted' => $value];
            DB::table(Status::$tableName)->where('id', $id)->update($delete_status);
            return true;
        }
        return false;
    }

    public static function getNNStatus()
    {
        return [
            'name' => 'Статус не установлен!',
            'description' => 'Статус заказа не установен. Требуется обратиться к администратору!',
        ];
    }
}
