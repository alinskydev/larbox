<?php

namespace Modules\Product\Search;

use App\Search\Search;

class ProductSearch extends Search
{
    protected array $relations = [
        'creator', 'category', 'brand',
        'variations', 'variations.options',
    ];

    protected array $filterable = [
        'id' => Search::FILTER_TYPE_EQUAL,
        'creator_id' => Search::SORT_TYPE_SIMPLE,
        'category_id' => Search::FILTER_TYPE_EQUAL,
        'brand_id' => Search::FILTER_TYPE_EQUAL,
        'model_number' => Search::FILTER_TYPE_LIKE,
        'sku' => Search::FILTER_TYPE_EQUAL,
        'date_eol' => Search::FILTER_TYPE_EQUAL,
        'is_active' => Search::FILTER_TYPE_EQUAL,
    ];

    protected array $sortable = [
        'id' => Search::SORT_TYPE_SIMPLE,
        'creator_id' => Search::SORT_TYPE_SIMPLE,
        'category_id' => Search::SORT_TYPE_SIMPLE,
        'brand_id' => Search::SORT_TYPE_SIMPLE,
        'model_number' => Search::SORT_TYPE_SIMPLE,
        'sku' => Search::SORT_TYPE_SIMPLE,
        'date_eol' => Search::SORT_TYPE_SIMPLE,
        'is_active' => Search::SORT_TYPE_SIMPLE,
    ];
}
