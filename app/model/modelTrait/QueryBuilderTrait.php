<?php

namespace app\model\modelTrait;

use Illuminate\Database\Eloquent\Builder;

trait QueryBuilderTrait
{
    /**
     * 常用的 query 参数构造
     * @param Builder $query
     * @param $conditions
     * @param $equalFields
     * @param array $likeFields
     * @param string $dateField
     * @return Builder
     */
    public static function commonQueryBuilder(Builder $query, $conditions, $equalFields, array $likeFields = [], string $dateField = 'created_at'): Builder
    {
        foreach ($conditions as $field => $value) {
            if (empty($value)) continue;

            if (in_array($field, $likeFields)) {
                $query = $query->where($field, 'like', "%{$value}%");
            } elseif (in_array($field, $equalFields)) {
                $query = $query->where($field, $value);
            }
        }

        if (issetNotEmpty($conditions, 'start_date') && $dateField) {
            $query = $query->whereDate($dateField, '>=', $conditions['start_date'] . ' 00:00:00');
        }
        if (issetNotEmpty($conditions, 'end_date') && $dateField) {
            $query = $query->whereDate($dateField, '<=', $conditions['end_date'] . ' 23:59:59');
        }

        return $query;
    }


}