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
     * @see
     */
    function slug(string $string)
    {
        return Str::slug($string, config('slug.separator'));
    }
}
