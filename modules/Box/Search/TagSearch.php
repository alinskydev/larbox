<?php

namespace Modules\Box\Search;

use App\Search\Search;

class TagSearch extends Search
{
    public array $filterable = [
        'id' => self::FILTER_TYPE_IN,
        'name' => self::FILTER_TYPE_LIKE,
    ];

    public array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
    ];
}
