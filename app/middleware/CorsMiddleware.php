<?php

namespace app\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class CorsMiddleware implements MiddlewareInterface
{

    public function process(Request $request, callable $handler): Response
    {
        # 允许跨域请求
        $response = $request->method() == 'OPTIONS' ? new Response(200) : $handler($request);
        return $response->withHeader('Access-Control-Allow-Origin', $request->header('Origin', '*'))
                        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
                        ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                        ->withHeader('Access-Control-Allow-Credentials', 'true');
    }
}