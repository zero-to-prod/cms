<?php

namespace Tests\App\Helpers;

use App\Helpers\UserHelper;
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
}
