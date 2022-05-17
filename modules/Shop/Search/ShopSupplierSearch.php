<?php

namespace Modules\Shop\Search;

use App\Search\Search;

class ShopSupplierSearch extends Search
{
    protected array $relations = [
        'creator', 'country',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'creator_id' => Search::FILTER_TYPE_EQUAL,
        'country_id' => Search::FILTER_TYPE_EQUAL,
        'short_name' => Search::FILTER_TYPE_LIKE,
        'full_name' => Search::FILTER_TYPE_LIKE,
        'is_active' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'creator_id' => Search::SORT_TYPE_SIMPLE,
        'country_id' => Search::SORT_TYPE_SIMPLE,
        'short_name' => Search::SORT_TYPE_SIMPLE,
        'full_name' => Search::SORT_TYPE_SIMPLE,
        'is_active' => Search::SORT_TYPE_SIMPLE,
    ];
}
