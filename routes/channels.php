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

use App\Models\AuthModel;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{key}', function (AuthModel $user, string $key) {
    /** @var $user Teacher|Student */
    if ($key === $user->user_key) {
        return ['id' => $user->id, 'name' => $user->name, 'identity' => $user->identity];
    }
    return null;
});
