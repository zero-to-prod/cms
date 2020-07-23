<?php

namespace Tests\App\Helpers;

use App\Helpers\Helper;
use Tests\TestCase;

class HelperTest extends TestCase
{
    /**
     * @see Helper::slug()
     * @test
     */
    public function slug(): void
    {
        $subject = 'Test Subject';
        $needle = config('slug.separator');
        $haystack = Helper::slug($subject);
        self::assertStringContainsString($needle, $haystack);
        self::assertIsString($haystack);
    }

    /**
     * @see Helper::slugLink()
     * @test
     */
    public function slugLink(): void
    {
        $subject = 'Test Subject';
        $needle = config('slug.separator_link');
        $haystack = Helper::slugLink($subject);
        self::assertStringContainsString($needle, $haystack);
        self::assertIsString($haystack);
    }
}
