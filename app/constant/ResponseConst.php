<?php

namespace app\constant;

class ResponseConst
{
    const CODE_OK    = 0;   # 成功
    const CODE_ERROR = 1;   # 错误

    const CODE_AUTH = 100100;  # 认证/权限相关问题

    public static function codeMapping(): array
    {
        return [
            self::CODE_OK    => 'success',
            self::CODE_ERROR => 'failure',
        ];
    }

    public static function getCodeMsg(int $code, $default = ''): string
    {
        return getUnsetFieldValue(self::codeMapping(), $code, $default);
    }

}