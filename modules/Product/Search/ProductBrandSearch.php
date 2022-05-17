<?php

namespace Modules\Product\Search;

use App\Search\Search;

class ProductBrandSearch extends Search
{
    protected array $relations = [
        'creator',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'creator_id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LIKE,
        'is_active' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'creator_id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_SIMPLE,
        'is_active' => Search::SORT_TYPE_SIMPLE,
    ];
}
