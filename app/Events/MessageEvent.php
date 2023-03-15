<?php

namespace App\Events;

use App\Models\AuthModel;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Teacher|Student|null
     */
    public $from;

    /**
     * @var Teacher|Student
     */
    private $to;

    public $message;

    public $time;

    public function __construct($from, AuthModel $to, string $message, int $time)
    {
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
        $this->time = $time;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->to->user_key),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message';
    }
}