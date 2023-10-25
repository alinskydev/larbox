<?php

namespace Modules\Box\Search;

use App\Base\Search;
use App\Search\Enums\SearchFilterConditionEnum;
use App\Search\Enums\SearchFilterTypeEnum;
use App\Search\Enums\SearchSortTypeEnum;

class BoxSearch extends Search
{
    public array $relations = [
        'brand', 'variations', 'tags',
        'categories', 'categories.ancestors',
    ];

    public array $filters = [
        'id' => SearchFilterTypeEnum::EQUAL_RAW,
        'brand_id' => SearchFilterTypeEnum::EQUAL_RAW,
        'name' => SearchFilterTypeEnum::LOCALIZED_LIKE,
        'price' => SearchFilterTypeEnum::BETWEEN_NUMBER,
        'date' => SearchFilterTypeEnum::BETWEEN_DATE,
        'datetime' => SearchFilterTypeEnum::DATE,

        'tags.id' => SearchFilterTypeEnum::IN,

        'categories.id' => [
            'condition' => SearchFilterConditionEnum::OR_WHERE,
            'filters' => [
                'categories.id' => SearchFilterTypeEnum::EQUAL_RAW,
                'categories.ancestors.id' => SearchFilterTypeEnum::EQUAL_RAW,
            ],
        ],
    ];

    public array $sortings = [
        'id' => SearchSortTypeEnum::RAW,
        'name' => SearchSortTypeEnum::LOCALIZED,
        'date' => SearchSortTypeEnum::RAW,
        'datetime' => SearchSortTypeEnum::RAW,
    ];
}
