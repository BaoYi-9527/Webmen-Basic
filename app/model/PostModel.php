<?php

namespace app\model;

use app\model\modelTrait\QueryBuilderTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use support\Model;

/**
 * Class PostModel
 * @property int $id
 * @property int $type
 * @property int $status
 * @property int $is_top
 * @property int $is_original
 * @property int $company_id
 * @property int $city_id
 * @property string $title
 * @property string $desc
 * @property string $content
 * @property string $cover
 * @property int $author_id
 * @property string slug
 *
 */
class PostModel extends Model
{
    use QueryBuilderTrait;

    protected $table = 'post';
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

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

    public static function typeMapping(): array
    {
        return [
            self::TYPE_COMPANY => [
                'id' => self::TYPE_COMPANY,
                'name' => '推荐贴'
            ],
            self::TYPE_ISSUE => [
                'id' => self::TYPE_ISSUE,
                'name' => '灌水贴'
            ],
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyModel::class, 'company_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'author_id', 'id');
    }

    public static function updateDeleteStatus($id): int
    {
        return self::query()->where('id', $id)->update(['status' => self::STATUS_DELETED]);
    }


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

    public static function getDetail($id): object|null
    {
        return self::with([
            'company',
            'author:id,username,head_img,desc',
            'city:id,name'
        ])->leftJoin('post_statistics', 'post.id', '=', 'post_statistics.post_id')
            ->selectRaw('
            v0_post.*, 
            COALESCE(v0_post_statistics.views, 0) AS views, 
            COALESCE(v0_post_statistics.likes, 0) AS likes, 
            COALESCE(v0_post_statistics.comments, 0) AS comments
            ')->where('post.id', $id)->first();
    }

    public static function getPageList($condition, $page, $pageSize, $fields = ['*']): LengthAwarePaginator
    {
        $query = self::with([
            'company',
            'author:id,username,head_img,desc',
            'city:id,name'
        ])->leftJoin('post_statistics', 'post.id', '=', 'post_statistics.post_id')
            ->selectRaw('
            v0_post.*, 
            COALESCE(v0_post_statistics.views, 0) AS views, 
            COALESCE(v0_post_statistics.likes, 0) AS likes, 
            COALESCE(v0_post_statistics.comments, 0) AS comments
            ');

        self::commonQueryBuilder($query, $condition,
            ['type', 'status', 'is_top', 'is_original', 'company_id', 'author_id', 'city_id'],
            ['title']
        );

        return $query->paginate($pageSize, $fields, 'page', $page);
    }


}
