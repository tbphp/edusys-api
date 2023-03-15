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
     * @var Teacher|Student
     */
    private $user;

    public $message;

    public function __construct(AuthModel $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->user->user_key),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message';
    }
}
