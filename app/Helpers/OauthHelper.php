<?php

namespace App\Helpers;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;
use Tests\App\Helpers\OauthHelperTest;

class OauthHelper
{

    /**
     * @return mixed
     * @see OauthHelperTest::tokenUrl()
     */
    public static function tokenUrl()
    {
        return config('oauth.token_url');
    }

    /**
     * @param $name
     * @param  string  $userId
     * @param  string  $redirect
     * @param  string  $provider
     * @param  bool  $personalAccess
     * @param  bool  $password
     * @param  bool  $confidential
     *
     * @return mixed
     *
     * @see OauthHelperTest::create()
     */
    public static function create(
        $name,
        $userId = '',
        $redirect = '',
        $provider = '',
        $personalAccess = false,
        $password = false,
        $confidential = true
    ) {
        $ClientRepository = new ClientRepository();

        return $ClientRepository->create(
            $userId,
            $name,
            $redirect,
            $provider,
            $personalAccess,
            $password,
            $confidential
        );
    }

    /**
     * Creates a Password Grant Client.
     *
     * @param  string  $name
     *
     * @param  string  $provider
     *
     * @return int
     * @see OauthHelperTest::createPasswordGrantClient()
     */
    public static function createPasswordGrantClient(
        string $name = 'Password Grant Client',
        string $provider = 'users'
    ): int {
        return Artisan::call("passport:client --password --name='$name' --provider='$provider'");
    }

    /**
     * Returns an associative array of scopes
     *
     * @return Repository|Application|mixed
     * @see OauthHelperTest::scopes()
     */
    public static function scopes(): array
    {
        return config('oauth.scopes');
    }
}
