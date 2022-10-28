<?php

namespace Modules\Box\Search;

use App\Base\Search;

class CategorySearch extends Search
{
    public array $defaultSort = ['name'];

    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'parent_id' => self::FILTER_TYPE_EQUAL,
        'depth' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LOCALIZED,
    ];

    public array $sortings = [
        'name' => self::SORT_TYPE_LOCALIZED,
    ];
}
