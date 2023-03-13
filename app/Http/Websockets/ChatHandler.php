<?php

namespace App\Http\Websockets;

use App\Enums\ChatActionEnum;
use App\Models\OfflineMessage;
use Exception;
use Illuminate\Support\Arr;
use Ratchet\ConnectionInterface;
use Throwable;

class ChatHandler
{
    protected $pusher;

    protected $conn;

    protected $msg;

    /**
     * @param Pusher $pusher
     * @param ConnectionInterface $conn
     * @param string $msg
     */
    public function __construct(Pusher $pusher, ConnectionInterface $conn, string $msg)
    {
        $this->pusher = $pusher;
        $this->conn = $conn;
        $this->msg = $msg;
    }

    public function handle()
    {
        try {
            $data = json_decode($this->msg, true);
        } catch (Exception $e) {
            $this->pusher->console->error(sprintf('数据解析失败：%s', $e->getMessage()));
            return;
        }

        // 验证消息字段格式
        if (empty($data['action'])) {
            $this->pusher->console->error(sprintf('数据异常：%s', $this->msg));
            return;
        }

        $action = 'action' . ucfirst($data['action']);
        if (!method_exists($this, $action)) {
            $this->pusher->console->error(sprintf('动作不存在：%s', $action));
            return;
        }

        try {
            $this->$action($data['data'] ?? '');
        } catch (Throwable $e) {
            $this->pusher->console->error(sprintf('执行动作失败：%s', $e->getMessage()));
        }
    }

    /**
     * 发送消息（单聊）
     *
     * @return void
     */
    public function actionSend(array $data)
    {
        if (empty($data['user'])) {
            return;
        }

        $msgData = [
            'user' => Arr::only($this->pusher->clients[$this->conn], ['id', 'name', 'identity']),
            'content' => $data['content'] ?? '',
            'time' => time(),
        ];

        $key = sprintf('%d-%d', $data['user']['identity'] ?? 0, $data['user']['id'] ?? 0);
        if (empty($conn = $this->pusher->users[$key] ?? null)) {
            // 如果用户不在线，则保存离线消息
            OfflineMessage::create([
                'type' => OfflineMessage::TYPE_USER,
                'user_key' => $key,
                'data' => $msgData,
            ]);
            return;
        }

        $this->pusher->msg($conn, ChatActionEnum::MSG, [
            'list' => [$msgData],
        ]);
    }
}
