<?php

namespace Modules\Region\Search;

use App\Search\Search;

class RegionCitySearch extends Search
{
    protected array $relations = [
        'region',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'region_id' => Search::FILTER_TYPE_IN,
        'name' => Search::FILTER_TYPE_LOCALIZED,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'region_id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_LOCALIZED,
    ];
}
