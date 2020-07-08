<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('users', function ($user, $value) {
    return true; // or false
});

Broadcast::channel('orderStatus', function ($user, $value) {
    return true; // or false
});

Broadcast::channel('orderStatus-{userId}', function ($user, $value) {
    // $user    User model instance passed by Auth authentication
    // $value   The userId value to which the channel rule matches
    return $user->id == $value; // Can use any criteria to verify that this user can listen to this channel
});
