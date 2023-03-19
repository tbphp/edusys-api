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

    public $id;

    /**
     * @var array|null
     */
    public $from;

    /**
     * @var Teacher|Student
     */
    private $to;

    public $message;

    public $time;

    /**
     * @param int $id
     * @param Teacher|Student|null $from
     * @param Teacher|Student $to
     * @param string $message
     * @param int $time
     */
    public function __construct(int $id, $from, AuthModel $to, string $message, int $time)
    {
        $this->id = $id;
        if ($from) {
            $this->from = $from->only(['identity', 'id', 'name']);
        }
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
