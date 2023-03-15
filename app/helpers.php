<?php

use App\Models\AuthModel;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Contracts\Cache\Lock;
use Illuminate\Support\Facades\DB;
use LINE\Laravel\Facade\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

/**
 * 记录sql的开始点
 */
function sql_start()
{
    DB::flushQueryLog();
    DB::enableQueryLog();
}

/**
 * 获取从开始点记录的所有sql
 */
function sql(): array
{
    return DB::getQueryLog();
}

/**
 * 添加表注释
 *
 * @param string $table_name 表名
 * @param string $comment 注释内容
 */
function table_comment(string $table_name, string $comment)
{
    DB::statement('ALTER TABLE `' . $table_name . '` comment "' . $comment . '"');
}

/**
 * 获取原子锁，用于防止并发
 *
 * 使用示例：
 *  ```php
 *  $lock = lock('customize_lock_key');
 *  if (!$lock->get()) {
 *      throw new DefaultException('操作频繁，请稍后再试');
 *  }
 *  # 业务逻辑代码...
 *  $lock->release(); // 释放锁
 *  ```
 *
 * @param string $key 原子锁字符串key
 * @param int $seconds 死锁时间（单位秒），需要大于逻辑执行时间。
 * @param mixed $owner
 * @return mixed
 */
function lock(string $key, int $seconds = 60, $owner = null): Lock
{
    /** @noinspection PhpUndefinedMethodInspection */
    return Cache::lock('lock:' . $key, $seconds, $owner);
}

/**
 * line消息推送
 *
 * @param Teacher|Student $user
 * @param string $message
 * @return void
 */
function line_message(AuthModel $user, string $message)
{
    $lineId = $user->line_id;
    if (empty($lineId) || empty($message)) {
        return;
    }

    /** @noinspection PhpUndefinedMethodInspection */
    LINEBot::pushMessage(
        $lineId,
        new TextMessageBuilder($message)
    );
}
