<?php

namespace App\Http\Controllers;

use App\Enums\IdentityEnum;
use App\Exceptions\CException;
use App\Http\Requests\LineBindRequest;
use App\Http\Requests\LineLoginRequest;
use App\Models\AuthModel;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class LineController extends Controller
{
    protected function _token(string $code): string
    {
        $client = new Client();
        try {
            $response = $client->post(config('services.line.host') . '/oauth2/v2.1/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => config('services.line.redirect_uri'),
                    'client_id' => config('services.line.channel_id'),
                    'client_secret' => config('services.line.channel_secret'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data['id_token'] ?? '';
        } catch (Exception $e) {
            return '';
        }
    }

    protected function _userId(string $code): string
    {
        $token = $this->_token($code);
        if (empty($token)) {
            return '';
        }

        try {
            $client = new Client();
            $response = $client->post(config('services.line.host') . '/oauth2/v2.1/verify', [
                'form_params' => [
                    'client_id' => config('services.line.channel_id'),
                    'id_token' => $token,
                ],
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data['sub'] ?? '';
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * @param Teacher|Student $user
     * @param int $identity
     * @return array
     */
    protected function _userToken(AuthModel $user, int $identity): array
    {
        $guard = IdentityEnum::getDescription($identity);
        $tokenName = ucfirst($guard) . ' Token';
        $user->tokens()->where('name', $tokenName)->delete();
        $token = $user->createToken($tokenName, [$guard]);
        return [
            'token_type' => 'bearer',
            'access_token' => $token->accessToken,
            'identity' => $identity,
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'bind_line' => (bool)$user->line_id,
        ];
    }

    public function login(LineLoginRequest $request)
    {
        $userId = $this->_userId($request->input('code'));
        if (empty($userId)) {
            throw new CException('授权失败，请重试！');
        }

        $tokens = [];
        $teachers = Teacher::where('line_id', $userId)->get();
        foreach ($teachers as $teacher) {
            $tokens[] = $this->_userToken($teacher, IdentityEnum::TEACHER);
        }
        $students = Student::where('line_id', $userId)->get();
        foreach ($students as $student) {
            $tokens[] = $this->_userToken($student, IdentityEnum::STUDENT);
        }

        if (empty($tokens)) {
            // 绑定临时令牌
            $hash = encrypt([
                'time' => time(),
                'line_id' => $userId,
            ]);
        } else {
            $hash = '';
        }

        return compact('tokens', 'hash');
    }

    /**
     * 绑定
     *
     * @throws AuthenticationException
     */
    public function bind(LineBindRequest $request)
    {
        if ($request->filled('code')) {
            $lineId = $this->_userId($request->input('code'));
            if (empty($lineId)) {
                throw new CException('授权失败，请重试！');
            }
        } else {
            // 如果是hash，则解析
            /** @var array $data */
            $data = decrypt($request->input('hash'));
            if (!isset($data['line_id'], $data['time'])) {
                throw new CException('参数错误');
            }
            if (time() - $data['time'] > 300) {
                throw new CException('绑定超时，请重试！');
            }
            $lineId = $data['line_id'];
        }

        // 用户认证
        $guard = IdentityEnum::getDescription($request->input('identity'));
        /** @var Teacher|Student $user */
        $user = auth($guard)->authenticate();
        if (!$user->tokenCan($guard)) {
            throw new CException('无效的用户');
        }

        if ($user->line_id) {
            throw new CException('当前用户已经绑定，不能重复绑定！');
        }

        try {
            $user->update(['line_id' => $lineId]);
        } catch (Exception $e) {
            throw new CException('绑定失败');
        }
    }

    public function unBind(Request $request)
    {
        // 用户认证
        $guard = IdentityEnum::getDescription($request->input('identity'));
        /** @var Teacher|Student $user */
        $user = auth($guard)->authenticate();
        if (!$user->tokenCan($guard)) {
            throw new CException('无效的用户');
        }

        if (!$user->line_id) {
            throw new CException('当前用户没有绑定，无法解绑！');
        }

        $user->update(['line_id' => null]);
    }
}
