<?php

namespace App\Listeners;

use App\Events\RequestLog;
use App\Models\RequestLog as RequestLogModel;
use App\Models\User;

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
        $user = auth()->user();
        $request_log = new \App\Models\RequestLog();
        $request_log->user_id = $user->id ?? User::where('email', config('admin.email'))->first()->id;
        $request_log->path = $event->request->path();
        $request_log->request_response_time_delta = microtime(true) - LARAVEL_START;

        if (is_object($event->response->exception)) {
            $request_log->error_message = $event->response->exception->getMessage();
            $request_log->error = 1;
        }
        $request_log->save();
    }
}
