<?php

namespace Tests\App\Helpers;

use App\Helpers\OauthHelper;
use App\Models\OauthClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OauthHelperTest extends TestCase
{

    use DatabaseTransactions;
    use DatabaseMigrations;

    /**
     * @test
     * @see OauthHelper::getTokenUrl()
     */
    public function getTokenUrl(): void
    {
        self::assertIsString(OauthHelper::getTokenUrl());
    }

    /**
     * @test
     * @see OauthHelper::createPasswordGrantClient()
     */
    public function createPasswordGrantClient(): void
    {
        $name     = 'Grant Client';
        $provider = 'provider';
        self::assertEquals(0, OauthHelper::createPasswordGrantClient($name, $provider));
        $oauth_client = OauthClient::where('name', $name)->first();
        self::assertInstanceOf(OauthClient::class, $oauth_client);
        self::assertEquals($name, $oauth_client->name);
        self::assertEquals($provider, $oauth_client->provider);
    }

    /**
     * @see OauthHelper::create()
     * @test
     */
    public function create(): void
    {
        $name           = 'Test Client';
        $user_id        = 100;
        $redirect       = 'url.domain';
        $provider       = 'provider';
        $personalAccess = true;
        $password       = true;
        $confidential   = true;

        $oauth_client = OauthHelper::create($name, $user_id, $redirect, $provider, $personalAccess, $password,
            $confidential);
        self::assertEquals($name, $oauth_client->name);
        self::assertEquals($user_id, $oauth_client->user_id);
        self::assertEquals($redirect, $oauth_client->redirect);
        self::assertTrue($oauth_client->personal_access_client);
        self::assertTrue($oauth_client->password_client);
        self::assertIsString($oauth_client->secret);
    }
}
