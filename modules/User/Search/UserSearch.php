<?php

namespace Modules\User\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterConditionEnum;
use App\Search\Enums\SearchFilterTypeEnum;
use App\Search\Enums\SearchSortTypeEnum;

class UserSearch extends Search
{
    public array $filters = [
        'id' => SearchFilterTypeEnum::IN,
        'role_id' => SearchFilterTypeEnum::EQUAL_RAW,

        'common' => [
            'condition' => SearchFilterConditionEnum::OR_WHERE,
            'filters' => [
                'username' => SearchFilterTypeEnum::LIKE,
                'email' => SearchFilterTypeEnum::LIKE,
                'profile.full_name' => SearchFilterTypeEnum::LIKE,
                'profile.phone' => SearchFilterTypeEnum::LIKE,
            ],
        ],
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
        'username' => SearchSortTypeEnum::RAW,
    ];
}
