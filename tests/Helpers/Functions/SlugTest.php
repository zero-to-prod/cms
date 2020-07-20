<?php

namespace Tests\Helpers\Functions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see slug() */
class SlugTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function see_if_function_exits(): void
    {
        $this->assertTrue(function_exists('slug'));
    }

    /** @test */
    public function has_separator(): void
    {
        $subject = 'Test Subject';
        $this->assertStringContainsString(config('slug.separator'), slug($subject));
    }
}
