<?php

namespace app\model\user;

use support\Model;

/**
 *
 */
class UserPostActionModel extends Model
{
    protected $table = 'user_post_action';

    const TYPE_LIKE    = 1;    // 点赞
    const TYPE_DISLIKE = 2;    // 评论
    const TYPE_STAR    = 3;    // 收藏
    const TYPE_WATCH   = 4;    // 关注

    public static function action($userId, $postId, $type = self::TYPE_LIKE)
    {
        # like 取消 dislike ; dislike 取消 like
        if ($type == self::TYPE_LIKE) {
            self::query()->where('user_id', $userId)->where('post_id', $postId)
                ->where('type', self::TYPE_DISLIKE)
                ->delete();
        } elseif ($type == self::TYPE_DISLIKE) {
            self::query()->where('user_id', $userId)->where('post_id', $postId)
                ->where('type', self::TYPE_LIKE)
                ->delete();
        }

        return self::query()->updateOrCreate([
            'user_id' => $userId,
            'post_id' => $postId,
            'type'    => $type
        ]);
    }

}
