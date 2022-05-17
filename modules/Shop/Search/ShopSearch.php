<?php

namespace Modules\Shop\Search;

use App\Search\Search;

class ShopSearch extends Search
{
    protected array $relations = [
        'agent', 'city', 'company',
        'suppliers', 'contacts', 'brands',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'agent_id' => Search::FILTER_TYPE_EQUAL,
        'city_id' => Search::FILTER_TYPE_EQUAL,
        'company_id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LIKE,
        'address' => Search::FILTER_TYPE_LIKE,
        'has_credit_line' => Search::FILTER_TYPE_EQUAL,
        'is_active' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'agent_id' => Search::SORT_TYPE_SIMPLE,
        'city_id' => Search::SORT_TYPE_SIMPLE,
        'company_id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_SIMPLE,
        'address' => Search::SORT_TYPE_SIMPLE,
        'has_credit_line' => Search::SORT_TYPE_SIMPLE,
        'is_active' => Search::SORT_TYPE_SIMPLE,
    ];
}
