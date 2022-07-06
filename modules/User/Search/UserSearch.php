<?php

namespace Modules\User\Search;

use App\Search\Search;

class UserSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'role' => self::FILTER_TYPE_EQUAL,
    ];

    public array $combinedFilters = [
        'common' => [
            'type' => self::COMBINED_TYPE_OR,
            'fields' => [
                'username' => self::FILTER_TYPE_LIKE,
                'email' => self::FILTER_TYPE_LIKE,
                'profile.full_name' => self::FILTER_TYPE_LIKE,
                'profile.phone' => self::FILTER_TYPE_LIKE,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'username' => self::SORT_TYPE_SIMPLE,
    ];
}
