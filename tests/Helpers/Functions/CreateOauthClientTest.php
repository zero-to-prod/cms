<?php

namespace Tests\Helpers\Functions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see create_oauth_client() */
class CreateOauthClientTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function see_if_function_exits(): void
    {
        self::assertTrue(function_exists('create_oauth_client'));
    }

    /** @test */
    public function create_oauth_client(): void
    {
        $name = 'Test Client';
        $user_id = 100;
        $redirect = 'url.domain';
        $provider = 'provider';
        $personalAccess = true;
        $password = true;
        $confidential = true;

        $oauth_client = create_oauth_client($name, $user_id, $redirect, $provider, $personalAccess, $password,
            $confidential);
        self::assertEquals($name, $oauth_client->name);
        self::assertEquals($user_id, $oauth_client->user_id);
        self::assertEquals($redirect, $oauth_client->redirect);
        self::assertTrue($oauth_client->personal_access_client);
        self::assertTrue($oauth_client->password_client);
        self::assertIsString($oauth_client->secret);
    }
}