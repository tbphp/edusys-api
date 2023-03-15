<?php

namespace App\Http\Controllers;

use App\Enums\ErrCode;
use App\Enums\GuardEnum;
use App\Enums\IdentityEnum;
use App\Exceptions\CException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TeacherRegisterRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Query\Builder;
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
        // 根据身份从auth配置里面获取模型
        $guard = IdentityEnum::getDescription($request->input('identity'));
        $provider = config('auth.guards.' . $guard . '.provider');
        $model = config('auth.providers.' . $provider . '.model');

        /** @var Builder $query */
        $query = (new $model)->newQuery();

        // 查找用户
        /** @var Teacher|Student $user */
        $user = $query->where('username', $request->input('username'))->first();
        if (empty($user)) {
            throw new CException(ErrCode::UNAUTHORIZED, '用户名或密码错误');
        }

        // 验证密码
        if (!Hash::check($request->input('password'), $user->password)) {
            throw new CException(ErrCode::UNAUTHORIZED, '用户名或密码错误');
        }

        // 删除旧token
        $user->tokens()->delete();

        // 创建用户token
        $token = $user->createToken(ucfirst($guard) . ' Token', [$guard]);

        return [
            'token_type' => 'bearer',
            'access_token' => $token->accessToken,
            'id' => $user->id,
            'name' => $user->name,
        ];
    }

    /**
     * 教师注册
     *
     * @param TeacherRegisterRequest $request
     * @return array
     */
    public function teacherRegister(TeacherRegisterRequest $request): array
    {
        $teacher = new Teacher($request->only(['name', 'username']));
        $teacher->password = Hash::make($request->input('password'));
        $teacher->save();

        // 创建用户token
        $token = $teacher->createToken('Teacher Token', [GuardEnum::TEACHER]);

        return [
            'token_type' => 'bearer',
            'access_token' => $token->accessToken,
            'id' => $teacher->id,
            'name' => $teacher->name,
        ];
    }
}
