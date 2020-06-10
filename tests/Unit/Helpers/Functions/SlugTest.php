<?php

namespace Tests\Unit\Helpers\Functions;

use Tests\TestCase;

/** @see slug() */
class SlugTest extends TestCase
{
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
