<?php

namespace App\Listeners;

use App\Cache\User\CacheUserAdmin;
use App\Cache\User\CacheUserAuth;
use App\Cache\User\CacheUser;
use App\Events\RequestLog;
use App\Models\RequestLog as RequestLogModel;

class RequestLogListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RequestLog  $event
     *
     * @return void
     */
    public function handle(RequestLog $event): void
    {

        $user                                     = CacheUserAuth::get();
        $request_log                              = new RequestLogModel();
        $request_log->user_id                     = $user->id ?? CacheUserAdmin::get()->id;
        $request_log->path                        = $event->request->path();
        $request_log->request_response_time_delta = microtime(true) - LARAVEL_START;

        if (is_object($event->response->exception)) {
            $request_log->error_message = $event->response->exception->getMessage();
            $request_log->error         = 1;
        }
        $request_log->save();
    }
}
