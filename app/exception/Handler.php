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
    /**
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render(Request $request, Throwable $exception): Response
    {
        $exceptionClass = get_class($exception);
        if (str_contains(strtoupper($exceptionClass), 'JWT') || $exception instanceof BusinessException) {
            return json([
                'code' => $exception->getCode(),
                'msg'  => $exception->getMessage(),
                'data' => []
            ]);
        }

        return parent::render($request, $exception);
    }
}