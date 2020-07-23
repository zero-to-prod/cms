<?php

namespace App\Helpers;

class EnvHelper
{
    public static $env_path;

    public function __construct()
    {
        self::$env_path = app()->environmentFilePath();
    }

    /**
     * @see EnvHelperTest::can_write_to_env()
     * @param $key
     * @param $value
     */
    public static function write($key, $value): void
    {
        $path = app()->environmentFilePath();
        $escaped = preg_quote('='.env($key), '/');
        $pattern = "/^{$key}{$escaped}/m";
        $replacement = "{$key}={$value}";

        if (preg_match($pattern, file_get_contents($path))) {
            file_put_contents($path,
                preg_replace($pattern, $replacement, file_get_contents($path)), LOCK_EX);
        } else {
            file_put_contents($path, PHP_EOL."{$key}={$value}", FILE_APPEND | LOCK_EX);
        }
    }

    // public static function delete($key){
    //
    //     $escaped     = preg_quote('='.env($key), '/');
    //     $pattern     = "/^{$key}{$escaped}/m";
    //     $replacement = "{$key}={$value}";
    //
    //     if (preg_match($pattern, file_get_contents($path))) {
    //         file_put_contents($path, preg_replace($pattern, $replacement, file_get_contents($path)));
    //     } else {
    //         file_put_contents($path, PHP_EOL."{$key}={$value}", FILE_APPEND | LOCK_EX);
    //     }
    // }
}
