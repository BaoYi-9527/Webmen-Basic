<?php

namespace app\model;

use support\Model;
use support\view\Raw;

/**
 *
 */
class CityStatisticsModel extends Model
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
    protected $table = 'city_statistics';

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

    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }

    public static function statistics($orderField = 'post_count')
    {
        return self::with(['city:id,name'])->orderByDesc($orderField)->get()->toArray();
    }
    
}
