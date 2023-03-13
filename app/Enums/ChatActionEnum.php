<?php

namespace App\Enums;

class ChatActionEnum extends BaseEnum
{
    /** @var string 动作：推送消息 */
    const MSG = 'msg';

    /** @var string 动作：系统通知 */
    const NOTIFY = 'notify';

    /** @var string 动作：错误消息 */
    const ERROR = 'error';
}
