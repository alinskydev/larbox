<?php

namespace Modules\Shop\Search;

use App\Search\Search;

class ShopContactSearch extends Search
{
    protected array $relations = [
        'creator',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'creator_id' => Search::FILTER_TYPE_EQUAL,
        'first_name' => Search::FILTER_TYPE_LIKE,
        'second_name' => Search::FILTER_TYPE_LIKE,
        'last_name' => Search::FILTER_TYPE_LIKE,
        'position' => Search::FILTER_TYPE_LIKE,
        'phone' => Search::FILTER_TYPE_LIKE,
        'is_active' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'creator_id' => Search::SORT_TYPE_SIMPLE,
        'first_name' => Search::SORT_TYPE_SIMPLE,
        'second_name' => Search::SORT_TYPE_SIMPLE,
        'last_name' => Search::SORT_TYPE_SIMPLE,
        'position' => Search::SORT_TYPE_SIMPLE,
        'phone' => Search::SORT_TYPE_SIMPLE,
        'is_active' => Search::SORT_TYPE_SIMPLE,
    ];
}
