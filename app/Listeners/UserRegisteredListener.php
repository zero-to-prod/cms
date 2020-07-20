<?php

namespace App\Listeners;

use App\Cache\CacheController;
use App\Events\UserRegistered;

class UserRegisteredListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     *
     * @return void
     */
    public function handle(UserRegistered $event): void
    {

    }
}
