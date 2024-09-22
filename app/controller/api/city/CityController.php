<?php

namespace app\controller\api\city;

use app\controller\api\ApiBaseController;
use app\model\CityStatisticsModel;
use support\Request;

class CityController extends ApiBaseController
{
    public function statistics(Request $request)
    {
        $data = CityStatisticsModel::statistics();
        return $this->success($data);
    }
}