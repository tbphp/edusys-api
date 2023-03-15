<?php

namespace App\Http\Controllers;

use App\Libs\Chat;
use App\Models\OfflineMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;
use Pusher\PusherException;

class PusherController extends Controller
{
    /**
     * 回调
     *
     * @throws PusherException
     */
    public function callback(Request $request)
    {
        $headers = [
            'X-Pusher-Key' => $request->header('X-Pusher-Key'),
            'X-Pusher-Signature' => $request->header('X-Pusher-Signature'),
        ];

        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id')
        );

        $webhook = $pusher->webhook($headers, $request->getContent());

        foreach ($webhook->get_events() as $event) {
            switch ($event->name) {
                case 'channel_occupied':
                    Log::info('用户上线：' . $event->channel);
                    $this->_offlineMessage($event->channel);
                    break;
                case 'channel_vacated':
                    Log::info('用户下线：' . $event->channel);
                    break;
            }
        }
    }

    /**
     * 获取离线消息
     *
     * @param string $userKey
     * @return void
     */
    protected function _offlineMessage(string $userKey)
    {
        $messages = OfflineMessage::where('user_key', $userKey)->get();
        if ($messages->isEmpty()) {
            return;
        }

        $messages->map(function (OfflineMessage $message) {
            (new Chat)->send(
                $message->userTo,
                $message->message,
                $message->type,
                false,
                $message->created_at->timestamp
            );
            $message->delete();
        });
    }
}
