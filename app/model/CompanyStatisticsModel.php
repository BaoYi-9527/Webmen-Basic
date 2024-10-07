<?php

namespace app\model;

use support\Model;

/**
 *
 */
class CompanyStatisticsModel extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_statistics';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public function company()
    {
        return $this->belongsTo(CompanyModel::class, 'company_id', 'id');
    }

    public static function getHotRank($orderField = 'post_count', $sort = 'desc')
    {
        return self::with(['company:id,name,desc,logo_url'])->orderBy($orderField, $sort)->get()->toArray();
    }
}
