<?php

namespace Modules\User\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterTypeEnum;
use App\Search\Enums\SearchSortTypeEnum;

class NotificationSearch extends Search
{
    public int $pageSize = 10;

    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'type' => SearchFilterTypeEnum::EQUAL_RAW,
        'is_seen' => SearchFilterTypeEnum::EQUAL_RAW,
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
    ];
}
