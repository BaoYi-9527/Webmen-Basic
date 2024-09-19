<?php

namespace app\controller\api;

use app\constant\ResponseConst;
use support\Response;

class ApiBaseController
{
    public function success($data = [], $msg = 'success', $code = ResponseConst::CODE_OK): Response
    {
        return json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ]);
    }

    public function fail($msg = 'failure', $code = ResponseConst::CODE_ERROR, $data = []): Response
    {
        return json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ]);
    }
}