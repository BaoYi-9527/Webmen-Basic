<?php

namespace app\exception;

use support\exception\BusinessException;
use Throwable;
use Tinywan\Jwt\Exception\JwtTokenException;
use Webman\Exception\ExceptionHandler;
use Webman\Http\Request;
use Webman\Http\Response;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render(Request $request, Throwable $exception): Response
    {
        if (($exception instanceof BusinessException) && ($response = $exception->render($request))) {
            return $response;
        } elseif ($exception instanceof JwtTokenException) {
            return json([
                'code' => $exception->getCode(),
                'msg'  => $exception->getMessage(),
                'data' => []
            ]);
        }

        return parent::render($request, $exception);
    }
}