<?php

namespace Modules\User\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterTypeEnum;
use App\Search\Enums\SearchSortTypeEnum;

class RoleSearch extends Search
{
    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'name' => SearchFilterTypeEnum::LOCALIZED_LIKE,
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
        'name' => SearchSortTypeEnum::LOCALIZED,
    ];
}
