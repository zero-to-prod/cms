<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Tests\Models;

use App\Models\AuthLog;
use App\Models\Contact;
use App\Models\Meta;
use App\Models\RequestLog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see User */
class UserTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @see User::auth_log()
     * @test
     */
    public function auth_log(): void
    {
        $auth_log = factory(AuthLog::class)->create();
        $query    = User::where('id', $auth_log->user_id)->with('auth_log')->first();

        self::assertInstanceOf(AuthLog::class, $query->auth_log);
    }

    /**
     * @see User::request_log()
     * @test
     */
    public function request_log(): void
    {
        $request_log = factory(RequestLog::class)->create();
        $query       = User::where('id', $request_log->user_id)->with('auth_log')->first();

        self::assertInstanceOf(RequestLog::class, $query->request_log);
    }

    /**
     * @see User::meta()
     * @test
     */
    public function meta(): void
    {
        $meta  = factory(Meta::class)->create(['user_id' => 3]);
        $user  = factory(User::class)->create(['meta_id' => $meta->id]);
        $query = User::where('id', $user->id)->with('meta')->first();

        self::assertInstanceOf(Meta::class, $query->meta);
    }

    /**
     * @see User::contact()
     * @test
     */
    public function contact(): void
    {
        $contact = factory(Contact::class)->create();
        $query = User::where('id', $contact->user_id)->with('contact')->first();

        self::assertInstanceOf(Contact::class, $query->contact);
    }
}
