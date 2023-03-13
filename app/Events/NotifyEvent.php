<?php

namespace App\Events;

use App\Models\Student;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class NotifyEvent implements ShouldBroadcastNow
{
    public $userKey;

    public $msg;

    public function __construct(string $userKey, string $msg)
    {
        $this->userKey = $userKey;
        $this->msg = $msg;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('notify'),
        ];
    }
}
