<?php

namespace app\model\user;

use support\Model;

/**
 *
 */
class UserModel extends Model
{
    protected $table = 'user';

    protected $guarded = [];

    const SYS_ADMIN = 1;    # 系统管理员
    
}
