<?php

namespace Tests\App\Helpers;

use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AdminHelperTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see AdminHelper::get()
     */
    public function getAdmin(): void
    {
        factory(User::class)->state('admin')->create();
        self::assertInstanceOf(User::class, AdminHelper::get());
    }

    /**
     * @test
     * @see AdminHelper::id()
     */
    public function id(): void
    {
        $user = factory(User::class)->state('admin')->create();
        self::assertEquals($user->id, AdminHelper::id());
    }

    /**
     * @test
     * @see AdminHelper::applyAllScopesToAdmin()
     */
    public function applyAllScopes(): void
    {
        Config::set('admin.apply_all_scopes', 1);
        self::assertTrue(AdminHelper::applyAllScopesToAdmin());
        Config::set('admin.apply_all_scopes', 0);
        self::assertFalse(AdminHelper::applyAllScopesToAdmin());
    }
}
