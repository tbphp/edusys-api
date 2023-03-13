<?php

namespace App\Http\Websockets;

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
            $this->pusher->console->error(sprintf('操作不存在：%s', $action));
            return;
        }

        try {
            $this->$action($data['data'] ?? '');
        } catch (Throwable $e) {
            $this->pusher->console->error(sprintf('执行操作失败：%s', $e->getMessage()));
        }
    }

    /**
     * 单聊
     *
     * @return void
     */
    public function actionChat(array $data)
    {
        if (empty($data['to'])) {
            return;
        }

        $key = sprintf('%d-%d', $data['to']['identity'] ?? 0, $data['to']['id'] ?? 0);
        /** @var $conn ConnectionInterface */
        if (empty($conn = $this->pusher->users[$key])) {
            return;
        }

        $conn->send(json_encode([
            'type' => 'msg',
            'content' => $data['content'] ?? '',
            'user' => Arr::only($this->pusher->clients[$conn], ['identity', 'id', 'name']),
        ]));
    }
}
