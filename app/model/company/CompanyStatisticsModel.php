<?php

namespace app\model\company;

use support\Model;

/**
 *
 */
class CompanyStatisticsModel extends Model
{
    protected $table = 'company_statistics';

    public function company()
    {
        return $this->belongsTo(CompanyModel::class, 'company_id', 'id');
    }

    public static function getHotRank($orderField = 'post_count', $sort = 'desc')
    {
        return self::with(['company:id,name,desc,logo_url'])->orderBy($orderField, $sort)->get()->toArray();
    }
}
