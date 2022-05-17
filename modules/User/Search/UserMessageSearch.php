<?php

namespace Modules\User\Search;

use App\Search\Search;

class UserMessageSearch extends Search
{
    protected array $relations = [
        'user',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'user_id' => Search::FILTER_TYPE_EQUAL,
        'is_sent_by_admin' => Search::FILTER_TYPE_EQUAL,
        'is_seen' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'user_id' => Search::SORT_TYPE_SIMPLE,
        'is_seen' => Search::SORT_TYPE_SIMPLE,
    ];
}
