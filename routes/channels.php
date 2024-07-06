<?php

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

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel('user-{recipientUserId}', function ($user, $recipientUserId) {
    Log::info("User attempting to join channel 'user-{$recipientUserId}'", ['user' => $user]);

    if ($user && $user->id == $recipientUserId) {
        Log::info("User is authenticated and matches recipient user ID", ['id' => $user->id, 'name' => $user->name]);
        return ['id' => $user->id, 'name' => $user->name];
    } else {
        Log::warning("User is not authenticated or does not match recipient user ID");
        return false;
    }
});
