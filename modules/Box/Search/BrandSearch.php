<?php

namespace Modules\Box\Search;

use App\Search\Search;

class BrandSearch extends Search
{
    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LIKE,
        'slug' => Search::FILTER_TYPE_EQUAL,
        'is_active' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_SIMPLE,
    ];
}
