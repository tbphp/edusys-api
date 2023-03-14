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

use App\Enums\GuardEnum;
use App\Models\AuthModel;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('my-channel', function (AuthModel $user) {

    // 验证多表用户权限
    if ($user instanceof Teacher) {
        return $user->tokenCan(GuardEnum::TEACHER);
    } else if ($user instanceof Student) {
        return $user->tokenCan(GuardEnum::STUDENT);
    }

    return false;
});
