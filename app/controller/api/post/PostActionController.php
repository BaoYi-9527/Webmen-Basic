<?php

namespace app\controller\api\post;

use app\controller\api\ApiBaseController;
use support\Request;

class PostActionController extends ApiBaseController
{
    public function like(Request $request)
    {
        return $this->success();
    }

    public function dislike(Request $request)
    {
        return $this->success();
    }

    public function star(Request $request)
    {
        return $this->success();
    }

    public function watch(Request $request)
    {
        return $this->success();
    }

}
