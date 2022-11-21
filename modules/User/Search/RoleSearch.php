<?php

namespace Modules\User\Search;

use App\Base\Search;

class RoleSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_TYPE_EQUAL_RAW,
        'name' => self::FILTER_TYPE_LOCALIZED,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_SIMPLE,
        'name' => self::SORT_TYPE_LOCALIZED,
    ];
}
