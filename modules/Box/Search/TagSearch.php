<?php

namespace Modules\Box\Search;

use App\Search\Search;

class TagSearch extends Search
{
    protected array $filterable = [
        'id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LIKE,
    ];

    protected array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
    ];
}
