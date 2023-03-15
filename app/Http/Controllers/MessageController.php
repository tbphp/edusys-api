<?php

namespace App\Http\Controllers;

use App\Enums\IdentityEnum;
use App\Exceptions\CException;
use App\Http\Requests\MessageStoreRequest;
use App\Libs\Chat;
use App\Models\Student;
use App\Models\Teacher;

class MessageController extends Controller
{
    public function store(MessageStoreRequest $request)
    {
        if ($request->input('identity') == IdentityEnum::TEACHER) {
            $user = Teacher::findOrFail($request->input('user_id'));
        } elseif ($request->input('identity') == IdentityEnum::STUDENT) {
            $user = Student::findOrFail($request->input('user_id'));
        } else {
            throw new CException('不正确的接收者');
        }

        (new Chat)->send($user, $request->input('message'));
    }
}
