<?php

namespace app\model;

use Illuminate\Database\Eloquent\Builder;
use support\Model;

/**
 *
 */
class PostModel extends Model
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
    protected $table = 'post';

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

    const TYPE_COMPANY = 1;
    const TYPE_ISSUE   = 2;

    const STATUS_DRAFT     = 1;
    const STATUS_WAITING   = 2;
    const STATUS_PUBLISHED = 3;
    const STATUS_HIDDEN    = 4;
    const STATUS_DELETED   = 5;
    const STATUS_EXPIRED   = 6;

    const IS_TOP  = 1;
    const NOT_TOP = 0;

    const IS_ORIGINAL  = 1;
    const NOT_ORIGINAL = 0;

    public static function createPost($params): \Illuminate\Database\Eloquent\Model|Builder
    {
        return self::query()->create([
            'type'         => getUnsetFieldValue($params, 'type', self::TYPE_COMPANY),
            'status'       => getUnsetFieldValue($params, 'status', self::STATUS_WAITING),
            'is_top'       => getUnsetFieldValue($params, 'is_top', self::NOT_TOP),
            'is_original'  => getUnsetFieldValue($params, 'is_original', self::NOT_ORIGINAL),
            'company_id'   => getUnsetFieldValue($params, 'company_id', 0),
            'title'        => $params['title'],
            'desc'         => getUnsetFieldValue($params, 'desc'),
            'content'      => $params['content'],
            'author_id'    => getUnsetFieldValue($params, 'author_id', UserModel::SYS_ADMIN),
            'cover'        => getUnsetFieldValue($params, 'cover'),
            'slug'         => getUnsetFieldValue($params, 'slug'),
            'original_url' => getUnsetFieldValue($params, 'original_url'),
        ]);
    }


}
