<?php

namespace App\Http\Websockets;

use App\Enums\IdentityEnum;
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
        /** @var ConnectionInterface $conn */
        foreach ($this->clients as $conn) {
            $conn->send($entry[1] ?? '');
        }
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // 用户认证
        /** @var Teacher|Student $user */
        $user = (new AuthHelper)->authenticate($conn);
        if (empty($user)) {
            $conn->send(trans('ratchet::messages.authorization'));
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

        $this->users[$key] = $conn;

        $this->clients->attach($conn, $userInfo);

        $this->console->info(sprintf(
            '用户[%s]%s上线，当前在线人数：%d',
            $userInfo['key'],
            $userInfo['name'],
            $this->clients->count()
        ));

        $conn->send(json_encode($user->toArray()));
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
}
