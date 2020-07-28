<?php

namespace App\Helpers;

use App\Models\Module;

class ModuleHelper
{
    /**
     * Determines if the request log is enabled.
     *
     * @return array
     * @see ModulesHelperTest::requestPatterns()
     * @see ModulesHelperTest::requestPatternsReturnsEmptyArray()
     */
    public static function requestPatterns(): array
    {
        $modules  = Module::where('is_enabled', true)->get(['id', 'path']);
        $patterns = [];
        foreach ($modules as $key => $module) {
            $patterns[] = $module->path;
        }

        return $patterns;
    }
}
