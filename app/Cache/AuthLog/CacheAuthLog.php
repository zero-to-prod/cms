<?php

namespace App\Cache\User;

use App\Contracts\CacheContract;
use App\Models\AuthLog;
use Illuminate\Support\Facades\Cache;

class CacheAuthLog implements CacheContract
{

    public static $key   = 'auth_log';
    public static $limit = 100;

    /**
     * @return mixed
     */
    public static function get()
    {
        return Cache::rememberForever(self::$key, static function () {
            return AuthLog::with('user')->orderBy('created_at', 'DESC')->limit(self::$limit)->get();
        });
    }

    /**
     * @return mixed
     */
    public static function rebuild()
    {
        self::forget();

        return self::get();
    }

    /**
     * @return bool
     */
    public static function forget(): bool
    {
        return Cache::forget(self::$key);
    }
}