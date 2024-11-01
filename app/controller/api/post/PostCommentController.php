<?php

namespace app\controller\api\post;

use app\controller\api\ApiBaseController;
use app\model\post\PostCommentModel;
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

    public function create(Request $request)
    {
        $postId    = $request->get('post_id');
        $content   = $request->get('content');
        $commentId = $request->get('comment_id', 0);

        PostCommentModel::publish([
            'post_id'    => $postId,
            'user_id'    => 1,
            'content'    => $content,
            'comment_id' => $commentId
        ]);

        return $this->success();
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');

        PostCommentModel::where('id', $id)->update(['status' => PostCommentModel::STATUS_DELETE]);

        return $this->success();
    }
}