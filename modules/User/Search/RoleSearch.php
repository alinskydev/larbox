<?php

namespace Modules\User\Search;

use App\Search\Search;

class RoleSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_IN,
        'name' => self::FILTER_TYPE_LOCALIZED,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
    ];
}
