<?php

namespace Modules\User\Search;

use App\Base\Search;

class RoleSearch extends Search
{
    public array $filters = [
        'id' => self::FILTER_CLASS_EQUAL_RAW,
        'name' => self::FILTER_CLASS_LOCALIZED_LIKE,
    ];

    public array $sortings = [
        'id' => self::SORT_TYPE_RAW,
        'name' => self::SORT_TYPE_LOCALIZED,
    ];
}
