<?php

use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channel Authorization
|--------------------------------------------------------------------------
|
| Here you may register all of the channel authorization callbacks that your
| application needs. The given authorization closure will be called when
| someone tries to subscribe to the channel.
|
*/

Broadcast::channel('room.{user_inviter_id}', function ($user, $user_inviter_id) {
    return (int) $user->id === (int) $user_inviter_id;
});

Broadcast::channel('conversation.{user_receiver_id}.{room_id}', function ($user, $user_receiver_id, $room_id) {
    return (int) $user->id === (int) $user_receiver_id ||
           (int) $user_receiver_id === (int) @Room::find($room_id)->admin->id;
});
