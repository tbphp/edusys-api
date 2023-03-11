<?php

namespace App\Enums;

class IdentityEnum extends BaseEnum
{
    /** @var int 用户身份：教师 */
    const TEACHER = 1;

    /** @var int 用户身份：学生 */
    const STUDENT = 2;

    public static $descriptions = [
        self::TEACHER => GuardEnum::TEACHER,
        self::STUDENT => GuardEnum::STUDENT,
    ];
}
