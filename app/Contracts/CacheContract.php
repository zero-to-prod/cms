<?php

namespace App\Contracts;

interface CacheContract
{
    public static function get();

    public static function forget();

    public static function rebuild();
}
