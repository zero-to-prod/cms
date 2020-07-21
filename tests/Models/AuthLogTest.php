<?php

namespace Tests\Models;

use App\Models\AuthLog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthLogTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see AuthLog::user()
     */
    public function user(): void
    {
        $user     = factory(User::class)->create();
        $auth_log = factory(AuthLog::class)->create(['user_id' => $user->id]);
        $query    = AuthLog::where('id', $auth_log->id)->with('user')->first();
        self::assertInstanceOf(User::class, $query->user);
    }
}
