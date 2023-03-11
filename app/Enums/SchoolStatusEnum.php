<?php

namespace App\Enums;

class SchoolStatusEnum extends BaseEnum
{
    /** @var int 学校状态：待审核 */
    const PENDDING = 1;

    /** @var int 学校状态：正常 */
    const NORMAL = 2;

    /** @var int 学校状态：已拒绝 */
    const REJECTED = 3;

    public static $descriptions = [
        self::PENDDING => '待审核',
        self::NORMAL => '正常',
        self::REJECTED => '已拒绝',
    ];
}
