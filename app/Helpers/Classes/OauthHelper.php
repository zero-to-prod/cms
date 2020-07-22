<?php

namespace App\Helpers\Classes;

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
}