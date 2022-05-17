<?php

namespace Modules\Product\Search;

use App\Search\Search;

class ProductSpecificationSearch extends Search
{
    protected array $relations = [
        'options',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LOCALIZED,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_LOCALIZED,
    ];
}
