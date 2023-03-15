<?php

namespace App\Libs;

use App\Events\MessageEvent;
use App\Events\SystemMessageEvent;
use App\Models\AuthModel;
use App\Models\OfflineMessage;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class Chat
{
    /**
     * 判断当前用户是否在线
     *
     * @param Teacher|Student $user
     * @return bool
     */
    protected function _online(AuthModel $user): bool
    {
        try {
            $puserh = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id')
            );
            $data = $puserh->get('/channels/private-chat.' . $user->user_key);
            return $data['status'] === 200 && $data['result']['occupied'];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 发送私聊消息
     *
     * @param Teacher|Student $to
     * @param string $message
     * @param int $type 消息类型
     * @param bool $needOnline 是否需要检查在线状态
     * @param int $time
     * @return void
     */
    public function send(
        AuthModel $to,
        string    $message,
        int       $type = OfflineMessage::TYPE_USER,
        bool      $needOnline = true,
        int       $time = 0
    )
    {
        // 获取发送者
        if ($type === OfflineMessage::TYPE_USER && Auth::check()) {
            $from = Auth::user();
        } else {
            $from = null;
        }

        if (!$needOnline || $this->_online($to)) {
            if ($type === OfflineMessage::TYPE_USER) {
                event(new MessageEvent($from, $to, $message, max($time, time())));
            } else {
                event(new SystemMessageEvent($to, $message, max($time, time())));
            }
        } else {
            $om = new OfflineMessage([
                'type' => $type,
                'user_key' => $to->user_key,
                'message' => $message,
            ]);

            $om->userFrom()->associate($from);
            $om->userTo()->associate($to);
            $om->save();
        }
    }
}
