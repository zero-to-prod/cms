<?php

namespace App\Helpers;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Tests\App\Helpers\ScopesHelperTest;

class ScopesHelper
{
    /**
     * Returns an associative array of scopes
     *
     * @return Repository|Application|mixed
     * @see ScopesHelperTest::tockensCan()
     */
    public static function tokensCan(): array
    {
        return config('scopes');
    }

    /**
     * Returns a space delimited string of scopes
     *
     * @return Repository|Application|mixed
     * @see ScopesHelperTest::asString()
     */
    public static function asString(): string
    {
        return (string)implode(' ', array_keys(config('scopes')));
    }
}
