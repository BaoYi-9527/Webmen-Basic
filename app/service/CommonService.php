<?php

namespace app\service;

use Illuminate\Pagination\LengthAwarePaginator;

class CommonService
{
    /**
     * 构造一个新的分页器
     * @param $items
     * @param LengthAwarePaginator $paginator
     * @return LengthAwarePaginator
     */
    public static function newPaginatorWithPrev($items, LengthAwarePaginator $paginator): LengthAwarePaginator
    {
        return new LengthAwarePaginator($items, $paginator->total(), $paginator->perPage(), $paginator->currentPage(), $paginator->getOptions());
    }
}