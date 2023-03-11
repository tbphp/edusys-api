<?php

namespace App\Exceptions;

use App\Enums\ErrCode;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use RedisException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($exception instanceof OAuthServerException) {
            return;
        }

        parent::report($exception);
    }

    public function render($request, Exception $e)
    {
        $response = parent::render($request, $e);
        $msg = $e->getMessage();
        if (empty($msg)) {
            $msg = ErrCode::getDescription($response->getStatusCode());
        }

        $result = [
            'code' => $response->getStatusCode(),
            'msg' => $msg,
            'data' => (object)null,
        ];

        switch (true) {
            // 字段验证异常
            case $e instanceof ValidationException:
                /** @var ValidationException $e */
                $errors = $e->errors();
                $error = reset($errors);
                if ($error) {
                    $result['msg'] = $error[0];
                }
                break;

            // 模型不存在异常
            case $e instanceof ModelNotFoundException:
                $result['code'] = ErrCode::DATA_NOT_FOUND;
                $result['msg'] = ErrCode::getDescription(ErrCode::DATA_NOT_FOUND);
                break;

            // 业务异常
            case $e instanceof CException:
                $msg = $e->getMessage();
                if ($msg) {
                    $result['msg'] = $msg;
                }
                break;

            case $e instanceof RedisException:
                return response('redis connection error', 500);

            case $e instanceof AuthenticationException:
                $result['code'] = ErrCode::UNAUTHORIZED;
                $result['msg'] = ErrCode::getDescription(ErrCode::UNAUTHORIZED);
                break;

            default:
                break;
        }

        return response()->json($result);
    }
}
