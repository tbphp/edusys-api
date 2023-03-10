<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class Result
{
    public function handle(Request $request, Closure $next)
    {
        // 强制请求为json类型
        $request->headers->set('Accept', 'application/json');

        /** @var Response $response */
        $response = $next($request);

        // 过滤
        if ($this->filter($response)) {
            return $response;
        }

        $result = [
            'code' => 200,
            'msg' => 'success',
            'data' => (object)json_decode($response->getContent()),
        ];

        return response()->json($result);
    }

    /**
     * 过滤不需要处理的返回
     *
     * @param Response $response
     * @return bool
     */
    private function filter(Response $response): bool
    {
        // 过滤异常
        if (property_exists($response, 'exception') && $response->exception) {
            return true;
        }

        // 过滤文件下载
        if ($response instanceof BinaryFileResponse) {
            return true;
        }

        return false;
    }
}
