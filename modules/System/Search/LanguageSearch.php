<?php

namespace Modules\System\Search;

use App\Search\Search;

class LanguageSearch extends Search
{
    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LIKE,
        'code' => Search::FILTER_TYPE_EQUAL,
        'is_active' => Search::FILTER_TYPE_EQUAL,
        'is_main' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_SIMPLE,
        'code' => Search::SORT_TYPE_SIMPLE,
    ];
}
