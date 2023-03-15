<?php

namespace App\Http\Controllers;

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
        Log::info('puserh_data', $request->all());
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id')
        );

        $webhook = $pusher->webhook($request->headers->all(), $request->getContent());
        foreach ($webhook->get_events() as $event) {
            Log::info('pusher_event', $event);
        }
    }
}
