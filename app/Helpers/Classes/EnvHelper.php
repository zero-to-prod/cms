<?php

namespace App\Helpers\Classes;

class EnvHelper
{

    /**
     * @param $key
     * @param $value
     */
    public static function write($key, $value): void
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}