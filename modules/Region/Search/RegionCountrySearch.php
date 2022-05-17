<?php

namespace Modules\Region\Search;

use App\Search\Search;

class RegionCountrySearch extends Search
{
    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'name' => Search::FILTER_TYPE_LOCALIZED,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'name' => Search::SORT_TYPE_LOCALIZED,
    ];
}
