<?php

namespace App\Libs;

use App\Events\MessageEvent;
use App\Events\SystemMessageEvent;
use App\Models\AuthModel;
use App\Models\OfflineMessage;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class Chat
{
    /**
     * 发送私聊消息
     *
     * @param Teacher|Student $to
     * @param string $message
     * @param int $type 消息类型
     * @param int $time
     * @param AuthModel|null $from
     * @return void
     */
    public function send(
        AuthModel $to,
        string    $message,
        int       $type = OfflineMessage::TYPE_USER,
        int       $time = 0,
        AuthModel $from = null
    )
    {
        // 获取发送者
        if (is_null($from) && $type === OfflineMessage::TYPE_USER && Auth::check()) {
            $from = Auth::user();
        }

        $om = new OfflineMessage([
            'type' => $type,
            'user_key' => $to->user_key,
            'message' => $message,
        ]);

        $om->userFrom()->associate($from);
        $om->userTo()->associate($to);
        $om->save();

        if ($type === OfflineMessage::TYPE_USER) {
            event(new MessageEvent($om->id, $from, $to, $message, max($time, time())));
        } else {
            event(new SystemMessageEvent($om->id, $to, $message, max($time, time())));
        }
    }
}
