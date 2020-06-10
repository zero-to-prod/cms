<?php

use Illuminate\Support\Str;

if (! function_exists('slug')) {
    /**
     * Generates a slug.
     *
     * @param  string  $string
     *
     * @return string
     *
     * @see \Tests\Unit\Helpers\Functions\SlugTest
     */
    function slug(string $string)
    {
        return Str::slug($string, config('slug.separator'));
    }
}
