<?php

namespace Modules\Product\Search;

use App\Search\Search;

class ProductVariationSearch extends Search
{
    protected array $relations = [
        'options',
    ];
}
