<?php

namespace App\Http\Controllers;

use App\Libs\Chat;
use App\Models\OfflineMessage;
use Exception;
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
                case 'client_event':
                    Log::info('client_event', [
                        'channel' => $event->channel,
                        'event' => $event->event,
                        'data' => $event->data,
                    ]);
                    if ($event->event === 'client_read') {
                        $this->_readMessage($event->channel, $event->data);
                    }
                    break;
            }
        }
    }

    /**
     * 获取离线消息
     *
     * @param string $channel
     * @return void
     */
    protected function _offlineMessage(string $channel)
    {
        // 获取userkey
        $arr = explode('.', $channel);
        $userKey = $arr[1] ?? '';
        if (empty($userKey)) {
            Log::error('channel不合法，无法获取userkey。channel:' . $channel);
            return;
        }

        $messages = OfflineMessage::where('user_key', $userKey)->get();
        if ($messages->isEmpty()) {
            return;
        }

        $messages->map(function (OfflineMessage $message) {
            (new Chat)->send(
                $message->userTo,
                $message->message,
                $message->type,
                $message->created_at->timestamp
            );
            $message->delete();
        });
    }

    /**
     * 消息已读
     *
     * @param string $channel
     * @param array $data
     * @return void
     * @throws Exception
     */
    protected function _readMessage(string $channel, array $data)
    {
        // 获取userkey
        $arr = explode('.', $channel);
        $userKey = $arr[1] ?? '';
        if (empty($userKey)) {
            Log::error('channel不合法，无法获取userkey。channel:' . $channel);
            return;
        }

        $id = $data['id'] ?? 0;
        if (empty($id)) {
            Log::error('数据不合法，无法获取id。');
            return;
        }

        OfflineMessage::where('user_key', $userKey)
            ->where('id', '<=', $id)
            ->delete();
    }
}
