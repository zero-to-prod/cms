<?php

namespace Tests\App\Helpers;

use App\Helpers\ModuleHelper;
use App\Models\Module;
use Tests\TestCase;

class ModulesHelperTest extends TestCase
{

    /**
     * @test
     * @see ModuleHelper::requestPatterns()
     */
    public function requestPatterns(): void
    {
        $module_0 = factory(Module::class)->state('enabled')->create();
        $module_1 = factory(Module::class)->state('enabled')->create();
        factory(Module::class)->state('disabled')->create();

        $request_patterns = ModuleHelper::requestPatterns();
        self::assertIsArray($request_patterns);
        self::assertEquals($module_0->path, $request_patterns[0]);
        self::assertEquals($module_1->path, $request_patterns[1]);
        self::assertFalse(isset($request_patterns[2]));
    }

    /**
     * @test
     * @see ModuleHelper::requestPatterns()
     */
    public function requestPatternsReturnsEmptyArray(): void
    {
        self::assertEquals([], ModuleHelper::requestPatterns());
    }
}
