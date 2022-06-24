<?php

namespace Modules\User\Search;

use App\Search\Search;

class UserSearch extends Search
{
    public array $filterable = [
        'id' => self::FILTER_TYPE_IN,
        'username' => self::FILTER_TYPE_LIKE,
        'email' => self::FILTER_TYPE_LIKE,
        'role' => self::FILTER_TYPE_EQUAL,

        'profile.full_name' => self::FILTER_TYPE_LIKE,
        'profile.phone' => self::FILTER_TYPE_LIKE,
    ];

    public array $sortable = [
        'id' => self::SORT_TYPE_SIMPLE,
        'username' => self::SORT_TYPE_SIMPLE,
    ];
}
