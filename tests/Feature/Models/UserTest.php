<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Tests\Feature\Models;

use App\Models\AuthLog;
use App\Models\Meta;
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
     * @see User::meta()
     * @test
     */
    public function meta(): void
    {
        $meta = factory(Meta::class)->create();
        $query    = User::where('id', $meta->user_id)->with('meta')->first();

        self::assertInstanceOf(Meta::class, $query->meta);
    }
}
