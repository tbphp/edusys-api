<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

abstract class AuthModel extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function serializeDate(DateTimeInterface $date): int
    {
        return $date->getTimestamp();
    }
}
