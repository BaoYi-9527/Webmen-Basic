<?php

namespace app\controller\api\company;

use app\controller\api\ApiBaseController;
use app\model\CompanyStatisticsModel;
use support\Request;

class CompanyController extends ApiBaseController
{
    public function hotRank(Request $request)
    {
        $data = CompanyStatisticsModel::getHotRank();
        return $this->success($data);
    }
}