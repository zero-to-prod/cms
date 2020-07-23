<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;

class OauthHelper
{
    /**
     * @return mixed
     * @see OauthHelperTest::getTokenUrl()
     */
    public static function getTokenUrl()
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

        return $ClientRepository->create($userId, $name, $redirect, $provider, $personalAccess, $password,
            $confidential);
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
}
