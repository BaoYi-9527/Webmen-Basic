<?php

namespace app\middleware;

use Tinywan\Jwt\JwtToken;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function process(Request $request, callable $handler): Response
    {
        $userId = JwtToken::getCurrentId();

        var_dump($userId);

        return $handler($request);
    }
}