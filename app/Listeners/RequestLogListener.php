<?php

namespace App\Listeners;

use App\Events\RequestLogEvent;
use App\Helpers\AdminHelper;
use App\Helpers\Helper;
use App\Models\RequestLog;

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
     * @param  RequestLogEvent  $event
     *
     * @return void
     */
    public function handle(RequestLogEvent $event): void
    {
        /** @todo Put this on a job. */
        $user                                     = auth()->user();
        $request_log                              = new RequestLog();
        $request_log->user_id                     = $user ?? AdminHelper::id();
        $request_log->path                        = $event->request->path();
        $request_log->request_response_time_delta = Helper::requestTime(LARAVEL_START);

        if (is_object($event->response->exception)) {
            $request_log->error_message = $event->response->exception->getMessage();
            $request_log->error         = 1;
        }
        $request_log->save();
    }
}
