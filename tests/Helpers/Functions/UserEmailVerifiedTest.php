<?php

namespace Tests\Helpers\Functions;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** @see user_email_verified() */
class UserEmailVerifiedTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function see_if_function_exits(): void
    {
        $this->assertTrue(function_exists('user_email_verified'));
    }

    /** @test */
    public function returns_false_when_email_verified_at_is_null(): void
    {
        $user = factory(User::class)->create();
        $this->assertFalse(user_email_verified($user->email));
    }

    /** @test */
    // public function returns_false_when_email_verified_at_is_not_null(): void
    // {
    //     $user = factory(User::class)->create(['email_verified_at' => 1]);
    //     $this->assertTrue(user_email_verified($user->email));
    // }
}
