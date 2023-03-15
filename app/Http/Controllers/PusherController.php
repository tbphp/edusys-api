<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Pusher\Pusher;
use Pusher\PusherException;

class PusherController extends Controller
{
    const CACHE_KEY = 'pusher_online';

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
                    Redis::sadd(self::CACHE_KEY, [$event->channel]);
                    Log::info('用户上线：' . $event->channel);
                    break;
                case 'channel_vacated':
                    Redis::srem(self::CACHE_KEY, $event->channel);
                    Log::info('用户下线：' . $event->channel);
                    break;
            }
        }

        Log::info('当前用户数：' . Redis::scard(self::CACHE_KEY));
    }
}
