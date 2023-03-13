<?php

namespace App\Http\Websockets;

use App\Enums\IdentityEnum;
use App\Models\AuthModel;
use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;
use ReflectionObject;

class AuthHelper
{
    /**
     * @return void
     */
    private function __clean()
    {
        $app = app();
        if (!isset($app['auth'])) {
            return;
        }
        $ref = new ReflectionObject($app['auth']);
        if ($ref->hasProperty('guards')) {
            $guards = $ref->getProperty('guards');
        } else if ($ref->hasProperty('drivers')) {
            $guards = $ref->getProperty('drivers');
        } else {
            return;
        }

        $guards->setAccessible(true);
        $guards->setValue($app['auth'], []);

        $app->forgetInstance('auth.driver');
        Facade::clearResolvedInstance('auth.driver');
    }

    /**
     * 用户认证
     *
     * @param ConnectionInterface $conn
     * @return AuthModel|null
     */
    public function authenticate(ConnectionInterface $conn)
    {
        // 解析query获取guard和token
        /** @var Request $request */
        $request = $conn->httpRequest;
        parse_str($request->getUri()->getQuery(), $query);
        $identity = $query['identity'] ?? '';
        $token = $query['token'] ?? '';

        if (empty($identity) || empty($token)) {
            return null;
        }

        $guard = IdentityEnum::getDescription($identity);

        request()->headers->set('Authorization', 'Bearer ' . $token);

        try {
            /** @var AuthModel $user */
            $user = auth($guard)->authenticate();

            $this->__clean();

            if ($user->tokenCan($guard)) {
                return $user;
            }
            return null;
        } catch (Exception $e) {
            Log::error('err', ['msg' => $e->getMessage()]);
            return null;
        }
    }
}
