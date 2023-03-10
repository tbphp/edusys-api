<?php

namespace App\Http\Controllers;

use App\Enums\ErrCode;
use App\Exceptions\CException;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * 登录
     *
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request)
    {
        // 查找用户
        $user = User::where('email', $request->input('email'))->first();
        if (empty($user)) {
            throw new CException(ErrCode::UNAUTHORIZED, '用户名或密码错误');
        }

        // 验证密码
        if (!Hash::check($request->input('password'), $user->password)) {
            throw new CException(ErrCode::UNAUTHORIZED, '用户名或密码错误');
        }

        // 创建用户token
        $token = $user->createToken('User Token');

        return [
            'access_token' => $token->accessToken,
        ];
    }

    public function test()
    {
        return ['abc'];
    }
}
