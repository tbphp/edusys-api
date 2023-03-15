<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class OfflineMessage extends Model
{
    /** @var int 消息类型：用户 */
    const TYPE_USER = 1;

    /** @var int 消息类型：系统 */
    const TYPE_SYSTEM = 2;

    protected $casts = [
        'type' => 'int',
    ];

    public function userFrom(): MorphTo
    {
        return $this->morphTo('from');
    }

    public function userTo(): MorphTo
    {
        return $this->morphTo('to');
    }
}
