<?php

namespace Modules\User\Search;

use App\Search\Search;

class UserSearch extends Search
{
    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'username' => Search::FILTER_TYPE_EQUAL,
        'email' => Search::FILTER_TYPE_LIKE,
        'role' => Search::FILTER_TYPE_EQUAL,
        
        'profile.full_name' => Search::FILTER_TYPE_LIKE,
        'profile.phone' => Search::FILTER_TYPE_LIKE,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'username' => Search::SORT_TYPE_SIMPLE,
        'email' => Search::SORT_TYPE_SIMPLE,
        'role' => Search::SORT_TYPE_SIMPLE,
        
        'profile.full_name' => Search::SORT_TYPE_SIMPLE,
        'profile.phone' => Search::SORT_TYPE_SIMPLE,
    ];
}
