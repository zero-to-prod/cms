<?php

namespace Tests\Models;

use App\Models\Meta;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MetaTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see Meta::site()
     */
    public function site(): void
    {
        $site = factory(Site::class)->create();
        $query = Site::where('id', $site->id)->with('meta')->first();
        self::assertInstanceOf(Meta::class, $query->meta);
    }

    /**
     * @test
     * @see Meta::user()
     */
    public function user(): void
    {
        $user = factory(User::class)->create();
        $query = User::where('id', $user->id)->with('meta')->first();
        self::assertInstanceOf(Meta::class, $query->meta);
    }
}
