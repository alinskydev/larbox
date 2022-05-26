<?php

namespace Modules\System\Search;

use App\Search\Search;

class LanguageSearch extends Search
{
    protected array $filterable = [
        'id' => self::FILTER_TYPE_EQUAL,
        'name' => self::FILTER_TYPE_LIKE,
        'code' => self::FILTER_TYPE_EQUAL,
        'is_active' => self::FILTER_TYPE_EQUAL,
        'is_main' => self::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_SIMPLE,
        'code' => self::SORT_TYPE_SIMPLE,
    ];
}