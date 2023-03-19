<?php

namespace App\Models;

use App\Enums\IdentityEnum;
use DateTimeInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

abstract class AuthModel extends Authenticatable
{
    use HasApiTokens;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'line_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'pivot', 'line_id'
    ];

    protected function serializeDate(DateTimeInterface $date): int
    {
        return $date->getTimestamp();
    }

    public function getIdentityAttribute(): int
    {
        return $this instanceof Teacher ? IdentityEnum::TEACHER : IdentityEnum::STUDENT;
    }

    /**
     * 获取多角色用户唯一key
     *
     * @return string
     */
    public function getUserKeyAttribute(): string
    {
        $identity = $this instanceof Teacher ? IdentityEnum::TEACHER : IdentityEnum::STUDENT;
        return sprintf('%d-%d', $identity, $this->attributes['id']);
    }
}
