<?php

namespace Tests\Helpers\Classes;

use App\Helpers\OauthHelper;
use Tests\TestCase;

class OauthHelperTest extends TestCase
{
    /**
     * @test
     * @see OauthHelper::getTokenUrl()
     */
    public function getTokenUrl(): void
    {
        self::assertIsString(OauthHelper::getTokenUrl());
    }
}
