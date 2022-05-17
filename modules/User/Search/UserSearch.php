<?php

namespace Modules\User\Search;

use App\Search\Search;

class UserSearch extends Search
{
    protected array $relations = [
        'regions', 'cities',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'username' => Search::FILTER_TYPE_EQUAL,
        'email' => Search::FILTER_TYPE_LIKE,
        'full_name' => Search::FILTER_TYPE_LIKE,
        'phone' => Search::FILTER_TYPE_LIKE,
        'role' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'username' => Search::SORT_TYPE_SIMPLE,
        'email' => Search::SORT_TYPE_SIMPLE,
        'full_name' => Search::SORT_TYPE_SIMPLE,
        'phone' => Search::SORT_TYPE_SIMPLE,
        'role' => Search::SORT_TYPE_SIMPLE,
    ];
}
