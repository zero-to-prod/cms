<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ModelContract
{
    public static function match(array $columns, $save = false);

    public static function validateRequest(Request $request);
}
