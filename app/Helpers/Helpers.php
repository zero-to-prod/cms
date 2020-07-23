<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helpers
{
    /**
     * Generates a slug.
     *
     * @param  string  $string
     *
     * @return string
     * @todo Refactor test.
     * @see
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
     * @todo Refactor test.
     * @see
     */
    public function slug_uri(string $string)
    {
        return Str::slug($string, config('slug.separator_uri'));
    }
}
