<?php

namespace App\Http;

use App\Models\User;
use http\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class RedisLogging {

    public const REDIS_VARIABLE_LOG = "mebelShopLogging";
    public const DATA_TIMING_REDIS = "timing";
    public const DATA_USER_LINK_REDIS = 'user_id';
    public const DATA_MESSAGE_REDIS = 'message';
    private const MAX_LOG_FILES = 100;

    //private const TIMING_LOG_FILE = 1200; Ограничение по временяни
    //Redis::command('Expire', [self::REDIS_VARIABLE_LOG, self::TIMING_LOG_FILE]);

    public static function saveLog($reaction, $table, $user_id){
        $data = [
            self::DATA_TIMING_REDIS  => date("Y-m-d H:i:s"),
            self::DATA_USER_LINK_REDIS => $user_id,
            self::DATA_MESSAGE_REDIS => "Произошло ".mb_strtolower($reaction)." на "." вкладке ".mb_strtolower($table)
        ];

        $json = json_encode($data, JSON_UNESCAPED_UNICODE);

        Redis::command('RPUSH', [self::REDIS_VARIABLE_LOG, $json]);

        self::cleanLast();
    }

    private static function cleanLast(){
        $lenLogs = Redis::command('LLEN', [RedisLogging::REDIS_VARIABLE_LOG]);
        if($lenLogs > self::MAX_LOG_FILES){
            Redis::command('BLPOP', [RedisLogging::REDIS_VARIABLE_LOG, 0]);
        }
    }

//    Продление времяни жизни
//    public static function extendLog(){
//        Redis::command('Expire', [self::REDIS_VARIABLE_LOG, self::TIMING_LOG_FILE]);
//    }

    public static function getLog(){
        $jsonCollection = Redis::command('LRange', [self::REDIS_VARIABLE_LOG, 0, -1]);
        $simpleDict = [];
        foreach($jsonCollection as $json){
            $simpleDict[] = (Object)json_decode($json, JSON_UNESCAPED_UNICODE);
        }
        return collect($simpleDict);
    }

    public static function clearLog(){
        Redis::command('DEL', [self::REDIS_VARIABLE_LOG]);
    }
}
