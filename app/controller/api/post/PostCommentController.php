<?php

namespace app\controller\api\post;

use app\controller\api\ApiBaseController;
use app\model\PostCommentModel;
use support\Request;
use support\Response;

class PostCommentController extends ApiBaseController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function list(Request $request)
    {
        $postId   = $request->get('post_id');
        $page     = $request->get('page', 1);
        $pageSize = $request->get('pageSize', 10);

        $list = PostCommentModel::getPageList($postId, ['status' => PostCommentModel::STATUS_VALID], $page, $pageSize);

        return $this->success($list);
    }
}