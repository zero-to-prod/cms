<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Tests\App\Helpers\HelperTest;

class Helper
{
    /**
     * Generates a slug.
     *
     * @param  string  $string
     *
     * @return string
     * @see HelperTest::slug()
     */
    public static function slug(string $string): string
    {
        return Str::slug($string, config('slug.separator'));
    }

    /**
     * Generates a slug for a URI.
     *
     * @param  string  $string
     *
     * @return string
     * @see HelperTest::slugLink()
     */
    public static function slugLink(string $string): string
    {
        return Str::slug($string, config('slug.separator_link'));
    }

    /**
     * Returns the difference between LARAVEL_START and when this method is called.
     *
     * @param $time
     *
     * @return mixed
     * @see HelperTest::requestTime()
     */
    public static function requestTime($time)
    {
        return microtime(true) - $time;
    }
}
