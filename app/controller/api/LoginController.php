<?php

namespace app\controller\api;

use support\Request;
use support\Response;

class LoginController extends ApiBaseController
{
    public function login(Request $request): Response
    {
        return $this->success();
    }
}