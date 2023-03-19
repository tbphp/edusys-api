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

class SystemMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;

    /**
     * @var Teacher|Student
     */
    private $to;

    public $message;

    public $time;

    public function __construct(int $id, AuthModel $to, string $message, int $time)
    {
        $this->id = $id;
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
        return 'notify';
    }
}
