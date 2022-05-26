<?php

namespace Modules\User\Search;

use App\Search\Search;

class UserSearch extends Search
{
    protected array $filterable = [
        'id' => self::FILTER_TYPE_EQUAL,
        'username' => self::FILTER_TYPE_EQUAL,
        'email' => self::FILTER_TYPE_LIKE,
        'role' => self::FILTER_TYPE_EQUAL,

        'profile.full_name' => self::FILTER_TYPE_LIKE,
    ];

    protected array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'username' => self::SORT_TYPE_SIMPLE,
        'email' => self::SORT_TYPE_SIMPLE,
        'role' => self::SORT_TYPE_SIMPLE,

        'profile.full_name' => self::SORT_TYPE_SIMPLE,
    ];
}
