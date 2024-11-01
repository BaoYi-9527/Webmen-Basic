<?php

namespace app\controller\api\post;

use app\controller\api\ApiBaseController;
use app\model\post\PostModel;
use support\Request;
use support\Response;

class PostController extends ApiBaseController
{

    public function filter(): Response
    {
        return $this->success([
            'type_mapping' => array_values(PostModel::typeMapping())
        ]);
    }

    /**
     * 分页
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        $params   = $request->get();
        $page     = getUnsetFieldValue($params, 'page', 1);
        $pageSize = getUnsetFieldValue($params, 'pageSize', 10);

        $params['status'] = PostModel::STATUS_PUBLISHED;
        $list             = PostModel::getPageList($params, $page, $pageSize);

        return $this->success($list);
    }

    public function detail(Request $request): Response
    {
        $id = $request->get('id');

        $detail = PostModel::getDetail($id);

        return $this->success($detail ? $detail->toArray() : []);
    }

    public function create(Request $request): Response
    {
        $params = $request->post();

        PostModel::createPost($params);

        return $this->success();
    }

    public function update(Request $request): Response
    {
        return $this->success();
    }

    public function delete(Request $request): Response
    {
        $id = $request->post('id');

        PostModel::updateDeleteStatus($id);

        return $this->success();
    }

}
