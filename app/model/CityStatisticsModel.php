<?php

namespace app\model;

use support\Model;
use support\view\Raw;

/**
 *
 */
class CityStatisticsModel extends Model
{
    protected $table = 'city_statistics';

    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }

    public static function statistics($orderField = 'post_count')
    {
        return self::with(['city:id,name'])->orderByDesc($orderField)->get()->toArray();
    }
    
}
