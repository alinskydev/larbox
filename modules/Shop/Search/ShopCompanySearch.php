<?php

namespace Modules\Shop\Search;

use App\Search\Search;

class ShopCompanySearch extends Search
{
    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LIKE,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_SIMPLE,
    ];
}
