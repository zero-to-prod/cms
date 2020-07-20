<?php

namespace Tests\Unit\Helpers\Functions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see slug_uri() */
class SlugUriTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function see_if_function_exits(): void
    {
        $this->assertTrue(function_exists('slug_uri'));
    }

    /** @test */
    public function has_separator(): void
    {
        $subject = 'Test Subject';
        $this->assertStringContainsString(config('slug.separator_uri'), slug_uri($subject));
    }
}
