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
    public function lastLogin()
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
}
