<?php

namespace Modules\Feedback\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterConditionEnum;
use App\Search\Enums\SearchFilterTypeEnum;
use App\Search\Enums\SearchSortTypeEnum;

class CallbackSearch extends Search
{
    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'status' => SearchFilterTypeEnum::EQUAL_RAW,
        
        'common' => [
            'condition' => SearchFilterConditionEnum::OR_WHERE,
            'filters' => [
                'full_name' => SearchFilterTypeEnum::LIKE,
                'phone' => SearchFilterTypeEnum::LIKE,
            ],
        ],
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
    ];
}
