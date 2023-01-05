<?php

namespace Modules\System\Search;

use App\Base\Search;
use App\Base\Search\Enums\SearchFilterConditionEnum;
use App\Base\Search\Enums\SearchFilterTypeEnum;
use App\Base\Search\Enums\SearchSortTypeEnum;

class LanguageSearch extends Search
{
    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'is_active' => SearchFilterTypeEnum::EQUAL_RAW,
        'is_main' => SearchFilterTypeEnum::EQUAL_RAW,
        
        'common' => [
            'condition' => SearchFilterConditionEnum::OR_WHERE,
            'filters' => [
                'name' => SearchFilterTypeEnum::LIKE,
                'code' => SearchFilterTypeEnum::EQUAL_STRING,
            ],
        ],
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
        'name' => SearchSortTypeEnum::RAW,
        'code' => SearchSortTypeEnum::RAW,
    ];
}
