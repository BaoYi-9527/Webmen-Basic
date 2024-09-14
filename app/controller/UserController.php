<?php

namespace app\controller;

use support\Request;
use support\Response;

class UserController
{
    public function hello(Request $request): Response
    {
        $default_name = 'webman';
        $name = $request->get('name', $default_name);
        return json([
            'code' => 0,
            'msg' => 'ok',
            'data' => $name
        ]);
    }

    public function response(Request $request): Response
    {
        return \response("Hello World");
    }


}