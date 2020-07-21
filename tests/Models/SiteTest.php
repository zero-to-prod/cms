<?php

namespace Tests\Models;

use App\Models\Meta;
use App\Models\Site;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see Site */
class SiteTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see Site::meta();
     */
    public function meta(): void
    {
        $site  = factory(Site::class)->create();
        $query = Site::where('id', $site->id)->with('meta')->first();
        self::assertInstanceOf(Meta::class, $query->meta);
    }
}
