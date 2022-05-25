<?php

namespace Modules\Box\Search;

use App\Search\Search;

class BoxSearch extends Search
{
    protected array $relations = [
        'brand', 'variations', 'tags',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'brand_id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LOCALIZED,
        'slug' => Search::FILTER_TYPE_EQUAL,
        'date' => Search::FILTER_TYPE_EQUAL,
        'datetime' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_LOCALIZED,
        'date' => Search::SORT_TYPE_SIMPLE,
        'datetime' => Search::SORT_TYPE_SIMPLE,
    ];
}
