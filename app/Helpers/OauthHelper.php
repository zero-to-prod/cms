<?php

namespace App\Helpers;

use Laravel\Passport\ClientRepository;
use Tests\Helpers\Classes\OauthHelperTest;

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
     * @see
     */
    function create_client(
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
}
