<?php

namespace App\Cache\User;

use App\Contracts\CacheContract;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CacheUser implements CacheContract
{
    public static $key = 'users';
    public static $limit = 100;

    /**
     * @param  array  $columns
     *
     * @return mixed
     */
    public static function get(array $columns = ['*'])
    {
        return Cache::rememberForever(self::$key, static function () use ($columns) {
            return User::all($columns)->take(self::$limit);
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
