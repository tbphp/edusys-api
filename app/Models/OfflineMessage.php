<?php

namespace App\Models;

class OfflineMessage extends Model
{
    /** @var int 消息类型：用户 */
    const TYPE_USER = 1;

    /** @var int 消息类型：系统 */
    const TYPE_SYSTEM = 2;

    public $timestamps = false;

    protected $casts = [
        'type' => 'int',
        'data' => 'array',
    ];
}
