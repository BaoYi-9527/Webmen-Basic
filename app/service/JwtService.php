<?php

namespace app\service;

use Tinywan\Jwt\JwtToken;

class JwtService
{
    public static function generateToken($params)
    {
        return JwtToken::generateToken($params);
    }
}