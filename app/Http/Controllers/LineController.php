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

class LineController extends Controller
{
    protected function _token(string $code): string
    {
        $client = new Client();
        try {
            $response = $client->post('https://api.line.me/oauth2/v2.1/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => 'http://localhost:5173',
                    'client_id' => '1660746199',
                    'client_secret' => '1de7b315fd95915d50535d3bc0703770',
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
            $response = $client->post('https://api.line.me/oauth2/v2.1/verify', [
                'form_params' => [
                    'client_id' => '1660746199',
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
        $user->tokens()->delete();
        $token = $user->createToken(ucfirst($guard) . ' Token', [$guard]);
        return [
            'token_type' => 'bearer',
            'access_token' => $token->accessToken,
            'identity' => $identity,
            'id' => $user->id,
            'name' => $user->name,
        ];
    }

    public function login(LineLoginRequest $request)
    {
        $userId = $this->_userId($request->input('code'));
        if (empty($userId)) {
            throw new CException('授权失败，请重试！');
        }

        $hash = '';
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
            $hash = encrypt([
                'time' => time(),
                'line_id' => $userId,
            ]);
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
        // 如何hash，则解析
        /** @var array $data */
        $data = decrypt($request->input('hash'));
        if (!isset($data['line_id'], $data['time'])) {
            throw new CException('参数错误');
        }
        if (time() - $data['time'] > 300) {
            throw new CException('绑定超时，请重试！');
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
            $user->update(['line_id' => $data['line_id']]);
        } catch (Exception $e) {
            throw new CException('绑定失败');
        }
    }
}
