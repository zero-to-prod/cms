<?php

namespace App\Cache;

use App\Cache\User\CacheAuthLog;
use App\Cache\User\CacheUser;
use App\Cache\User\CacheUserAdmin;
use App\Cache\User\CacheUserAuth;
use App\Cache\User\CacheUserEmails;

class CacheController
{

    public static $keys
        = [
            'users'    => [
                CacheUser::class,
                CacheUserAdmin::class,
                CacheUserAuth::class,
            ],
            'auth_log' => [
                CacheAuthLog::class,
            ]
        ];

    /**
     * @param $cache
     */
    public static function clear($cache): void
    {
        foreach (self::$keys[$cache] as $key) {
            $key::forget();
        }
    }
}