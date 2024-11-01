<?php

namespace app\model;

use app\model\modelTrait\QueryBuilderTrait;
use support\Model;

/**
 *
 */
class PostCommentModel extends Model
{
    use QueryBuilderTrait;

    protected $table = 'post_comment';

    const STATUS_VALID  = 1;
    const STATUS_HIDDEN = 2;
    const STATUS_DELETE = 3;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function replyUser()
    {
        return $this->belongsTo(UserModel::class, 'reply_user_id', 'id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function getPageList($postId, $condition, $page, $pageSize, $fields = ['*'])
    {
        $query = self::with([
            'user:id,username,head_img,email,desc',
            'replyUser:id,username,head_img,email,desc',
        ])->where('post_id', $postId);

        self::commonQueryBuilder($query, $condition, ['status']);

        return $query->orderByDesc('is_top')->orderBy('id')->paginate($pageSize, $fields, 'page', $page);
    }

    public static function publish($params)
    {
        $commentId     = getUnsetFieldValue($params, 'comment_id', 0);
        $rootCommentId = $replyUserId = 0;
        if ($commentId) {
            $replyComment  = self::find($commentId);
            $replyUserId   = $replyComment->user_id;
            $rootCommentId = $replyComment->root_comment_id ? $replyComment->root_comment_id : $commentId;
        }

        return self::query()->create([
            'post_id'         => $params['post_id'],
            'user_id'         => $params['user_id'],
            'content'         => $params['content'],
            'comment_id'      => $commentId,
            'reply_user_id'   => $replyUserId,
            'root_comment_id' => $rootCommentId,
            'status'          => self::STATUS_VALID
        ]);
    }


    
}
