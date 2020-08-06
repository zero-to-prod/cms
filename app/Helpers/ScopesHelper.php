<?php

namespace App\Helpers;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;
use Tests\App\Helpers\OauthHelperTest;
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
}
