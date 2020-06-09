<?php

use Illuminate\Support\Str;

if ( ! function_exists('slug_uri')) {
    /**
     * Generates a slug for a URI
     *
     * @param  string  $string
     *
     * @return string
     *
     * @see \Tests\Unit\Helpers\Functions\SlugUriTest
     */
    function slug_uri(string $string)
    {
        return Str::slug($string, config('slug.separator_uri'));
    }
}