<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use Illuminate\Http\Response;

class AuthLogController extends Controller
{
    public function __invoke(Response $response)
    {
        return response(AuthLog::with('user')->orderBy('created_at', 'DESC')->limit(10)->get(), 200);
    }
}
