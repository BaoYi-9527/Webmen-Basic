<?php

namespace app\controller\api\city;

use app\controller\api\ApiBaseController;
use app\model\CityModel;
use app\model\CityStatisticsModel;
use support\Request;

class CityController extends ApiBaseController
{
    public function statistics(Request $request)
    {
        $data = CityStatisticsModel::statistics();
        return $this->success($data);
    }

    public function select(Request $request)
    {
        $name = $request->input('name');
        $data = CityModel::query()->select(['id', 'name'])->where('name', 'like', '%' . $name . '%')->get()->toArray();
        return $this->success($data);
    }
}