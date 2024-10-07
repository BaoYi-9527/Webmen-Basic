<?php

namespace app\controller\api\company;

use app\controller\api\ApiBaseController;
use app\model\CompanyModel;
use app\model\CompanyStatisticsModel;
use support\Request;

class CompanyController extends ApiBaseController
{
    public function hotRank(Request $request)
    {
        $data = CompanyStatisticsModel::getHotRank();
        return $this->success($data);
    }

    public function select(Request $request)
    {
        $name = $request->input('name');
        $data = CompanyModel::query()->select(['id', 'name', 'logo_url', 'desc'])->where('name', 'like', '%' . $name . '%')->get()->toArray();
        return $this->success($data);
    }
}