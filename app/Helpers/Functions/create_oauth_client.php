<?php

use Laravel\Passport\ClientRepository;

if (! function_exists('create_oauth_client')) {
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
     * @see \Tests\Unit\Helpers\Functions\CreateOauthClientTest
     */
    function create_oauth_client(
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
