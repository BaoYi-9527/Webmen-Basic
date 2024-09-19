<?php

namespace app\controller\api\post;

use app\controller\api\ApiBaseController;
use app\model\PostModel;
use support\Request;

class PostController extends ApiBaseController
{
    public function list(Request $request)
    {
        return $this->success();
    }

    public function detail(Request $request)
    {
        return $this->success();
    }

    public function create(Request $request)
    {
        $params = $request->post();

        PostModel::createPost($params);

        return $this->success();
    }

    public function update(Request $request)
    {
        return $this->success();
    }

    public function delete(Request $request)
    {
        return $this->success();
    }

}
