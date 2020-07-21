<?php

namespace Tests\Models;

use App\Models\AuthLog;
use App\Models\RequestLog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RequestLogTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see RequestLog::user()
     */
    public function user(): void
    {
        $user = factory(User::class)->create();
        $request_log = factory(RequestLog::class)->create(['user_id' => $user->id]);
        $query = RequestLog::where('id', $request_log->id)->with('user')->first();
        self::assertInstanceOf(User::class, $query->user);
    }
}
