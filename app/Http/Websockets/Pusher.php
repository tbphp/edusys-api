<?php

namespace App\Http\Websockets;

use App\Enums\ChatActionEnum;
use App\Enums\IdentityEnum;
use App\Models\OfflineMessage;
use App\Models\Student;
use App\Models\Teacher;
use Askedio\LaravelRatchet\Console\Commands\RatchetServerCommand;
use Askedio\LaravelRatchet\RatchetWsServer;
use Exception;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class Pusher extends RatchetWsServer
{
    /**
     * @var SplObjectStorage
     */
    public $clients;

    public $users;

    /**
     * @var RatchetServerCommand
     */
    public $console;

    public function onEntry($entry)
    {
        try {
            $data = json_decode($entry[1], true)['payload'] ?? [];
        } catch (Exception $e) {
            return;
        }
        if (empty($data['msg'])) {
            return;
        }

        $userKey = $data['userKey'] ?? '';

        $msgData = [
            'content' => $data['msg'],
            'time' => time(),
        ];

        // 如果用户id为空，则广播在线用户
        if (empty($userKey)) {
            if ($this->clients->count() > 0) {
                /** @var ConnectionInterface $conn */
                foreach ($this->clients as $conn) {
                    $this->msg($conn, ChatActionEnum::NOTIFY, [
                        'list' => [$msgData],
                    ]);
                }
            }
            return;
        }

        if (empty($userConn = $this->users[$userKey] ?? null)) {
            // 如果用户不在线，则保存离线消息
            OfflineMessage::create([
                'type' => OfflineMessage::TYPE_SYSTEM,
                'user_key' => $userKey,
                'data' => $msgData,
            ]);
            return;
        }

        $this->msg($userConn, ChatActionEnum::NOTIFY, [
            'list' => [$msgData],
        ]);
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // 用户认证
        /** @var Teacher|Student $user */
        $user = (new AuthHelper)->authenticate($conn);
        if (empty($user)) {
            $this->error($conn, '认证失败');
            $conn->close();
            return;
        }
        $identity = $user instanceof Teacher ? IdentityEnum::TEACHER : IdentityEnum::STUDENT;
        $key = sprintf('%d-%d', $identity, $user->id);
        $userInfo = [
            'key' => $key,
            'identity' => $identity,
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
        ];

        // 处理重复登陆，踢除之前的连接
        if (isset($this->users[$key])) {
            /** @var ConnectionInterface $oldConn */
            $oldConn = $this->users[$key];
            $this->error($oldConn, '你已经被挤下线');
            $oldConn->close();
            $this->onClose($oldConn);
        }

        $this->users[$key] = $conn;

        $this->clients->attach($conn, $userInfo);

        $this->console->info(sprintf(
            '用户[%s]%s上线，当前在线人数：%d',
            $userInfo['key'],
            $userInfo['name'],
            $this->clients->count()
        ));

        // 推送离线消息
        $this->_offline($conn, $key);
    }

    public function onMessage(ConnectionInterface $conn, $input)
    {
        $userInfo = $this->clients[$conn] ?? [];
        if (empty($userInfo)) {
            return;
        }

        $this->console->comment(sprintf(
            '来自[%s]%s的消息：%s',
            $userInfo['key'],
            $userInfo['name'],
            $input
        ));

        $handler = new ChatHandler($this, $conn, $input);
        $handler->handle();
    }

    public function onClose(ConnectionInterface $conn)
    {
        $userInfo = $this->clients[$conn] ?? [];
        if (empty($userInfo)) {
            return;
        }

        $this->clients->detach($conn);
        unset($this->users[$userInfo['key']]);

        $this->console->line(sprintf(
            '用户[%s]%s下线，当前在线人数：%d',
            $userInfo['key'],
            $userInfo['name'],
            $this->clients->count()
        ));
    }

    public function onError(ConnectionInterface $conn, Exception $exception)
    {
        $msg = $exception->getMessage();
        $conn->close();
        $this->console->error(sprintf('监听到错误：%s', $msg));
    }

    /**
     * 发送消息
     *
     * @param ConnectionInterface $conn
     * @param string $action
     * @param array $data
     * @return void
     */
    public function msg(ConnectionInterface $conn, string $action, array $data = [])
    {
        $conn->send(json_encode([
            'action' => $action,
            'data' => $data,
        ]));
    }

    /**
     * 发送错误消息
     *
     * @param ConnectionInterface $conn
     * @param string $msg
     * @return void
     */
    public function error(ConnectionInterface $conn, string $msg)
    {
        $conn->send(json_encode(['action' => ChatActionEnum::ERROR, 'msg' => $msg]));
    }

    /**
     * 处理离线消息
     *
     * @param ConnectionInterface $conn
     * @param string $key
     * @return void
     */
    protected function _offline(ConnectionInterface $conn, string $key)
    {
        $offlineMessages = OfflineMessage::where('user_key', $key)->get();

        // 用户消息
        $userMessages = $offlineMessages
            ->where('type', OfflineMessage::TYPE_USER)
            ->pluck('data')
            ->toArray();
        if ($userMessages) {
            $this->msg($conn, ChatActionEnum::MSG, ['list' => $userMessages]);
        }

        // 系统通知
        $systemMessages = $offlineMessages
            ->where('type', OfflineMessage::TYPE_SYSTEM)
            ->pluck('data')
            ->toArray();
        if ($systemMessages) {
            $this->msg($conn, ChatActionEnum::NOTIFY, ['list' => $systemMessages]);
        }

        // 清空消息
        if ($offlineMessages->isNotEmpty()) {
            $offlineMessages->map(function (OfflineMessage $offlineMessage) {
                $offlineMessage->delete();
            });
        }
    }
}
