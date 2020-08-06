<?php

namespace Tests\App\Helpers;

use App\Helpers\UserHelper;
use App\Models\AuthLog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserHelperTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see UserHelper::fromEmail()
     */
    public function fromEmail(): void
    {
        $user = factory(User::class)->create();
        factory(User::class, 3)->create();
        self::assertInstanceOf(User::class, UserHelper::fromEmail($user->email));
    }

    /**
     * @test
     * @see UserHelper::idFromEmail()
     */
    public function idFromEmail(): void
    {
        $user = factory(User::class)->create();
        factory(User::class, 3)->create();
        self::assertEquals($user->id, UserHelper::idFromEmail($user->email));
    }

    /**
     * @test
     * @see UserHelper::emailIsVerified()
     */
    public function emailIsVerified(): void
    {
        $email = 'test_email@location.domain';
        $user  = factory(User::class)->create(['email_verified_at' => now(), 'email' => $email]);

        self::assertTrue(UserHelper::emailIsVerified($user->email));
    }

    /**
     * @test
     * @see UserHelper::emailIsNotVerified()
     */
    public function emailIsNotVerified(): void
    {
        $email = 'test_email@location.domain';
        $user  = factory(User::class)->create(['email_verified_at' => null, 'email' => $email]);

        self::assertTrue(UserHelper::emailIsNotVerified($user->email));
    }

    /**
     * @test
     * @see UserHelper::lastLogin()
     */
    public function lastLogin(): void
    {
        $user           = factory(User::class)->create();
        $auth_log       = factory(AuthLog::class)->create(['user_id' => $user->id, 'login' => 1]);
        $auth_log       = $auth_log->toArray();
        $logged_in_user = UserHelper::lastLogin($user->id)->toArray();
        self::assertEquals($auth_log['created_at'], $logged_in_user['created_at']);
        factory(AuthLog::class)->create(['user_id' => $user->id, 'login' => 1]);
        $logged_in_user = UserHelper::lastLogin($user->id, 1)->toArray();
        self::assertEquals($auth_log['created_at'], $logged_in_user['created_at']);
    }

    /**
     * @test
     * @see UserHelper::scopes()
     */
    public function scopes(): void
    {
        $scopes = 'admin';
        $user   = factory(User::class)->create(['scopes' => $scopes]);
        self::assertEquals($user->scopes, UserHelper::scopes($user->email));
    }

    /**
     * @test
     * @see UserHelper::scopesAsArray()
     */
    public function scopesAsArray(): void
    {
        $scopes = 'admin can_login';
        $user   = factory(User::class)->create(['scopes' => $scopes]);
        self::assertIsArray(UserHelper::scopesAsArray($user->email));
        self::assertEquals(['admin', 'can_login'], UserHelper::scopesAsArray($user->email));
    }

    /**
     * @test
     * @see UserHelper::canLogin()
     */
    public function canLoginTrue(): void
    {
        $user = factory(User::class)->create(['can_login' => 1]);
        self::assertTrue(UserHelper::canLogin($user->email));
    }

    /**
     * @test
     * @see UserHelper::canLogin()
     */
    public function canLoginFalse(): void
    {
        $user = factory(User::class)->create(['can_login' => 0]);
        self::assertFalse(UserHelper::canLogin($user->email));
    }

    /**
     * @test
     * @see UserHelper::cannotLogin()
     */
    public function cannotLogin(): void
    {
        $user = factory(User::class)->create(['can_login' => 0]);
        self::assertTrue(UserHelper::cannotLogin($user->email));
    }
}
