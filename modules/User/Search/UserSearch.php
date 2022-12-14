<?php

namespace Modules\User\Search;

use App\Base\Search;

class UserSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_CLASS_IN,
        'role_id' => self::FILTER_CLASS_EQUAL_RAW,

        'common' => [
            'condition' => self::FILTER_CONDITION_OR_WHERE,
            'filters' => [
                'username' => self::FILTER_CLASS_LIKE,
                'email' => self::FILTER_CLASS_LIKE,
                'profile.full_name' => self::FILTER_CLASS_LIKE,
                'profile.phone' => self::FILTER_CLASS_LIKE,
            ],
        ],
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
        'username' => self::SORT_TYPE_RAW,
    ];
}
