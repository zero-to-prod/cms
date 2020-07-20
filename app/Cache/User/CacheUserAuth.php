<?php

namespace App\Cache\User;

use App\Contracts\CacheContract;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CacheUserAuth implements CacheContract
{

    public static $key = 'users:auth';

    /**
     * @return array|mixed
     */
    public static function get()
    {
        return Cache::rememberForever(self::$key, static function () {
            return auth()->user();
        });
    }

    /**
     * @return bool
     */
    public static function forget(): bool
    {
        return Cache::forget(self::$key);
    }

    /**
     * @return array|mixed
     */
    public static function rebuild(): array
    {
        self::forget();

        return self::get();
    }
}