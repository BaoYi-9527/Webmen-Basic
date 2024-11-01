<?php

namespace app\model;

use support\Model;

/**
 *
 */
class CompanyModel extends Model
{
    protected $table = 'company';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


}
