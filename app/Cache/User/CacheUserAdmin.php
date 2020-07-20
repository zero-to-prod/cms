<?php

namespace App\Cache\User;

use App\Contracts\CacheContract;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CacheUserAdmin implements CacheContract
{
    public static $key = 'user:admin';

    /**
     * @return array|mixed
     */
    public static function get()
    {
        return Cache::rememberForever(self::$key, static function () {
            return User::where('email', config('admin.email'))->first();
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
