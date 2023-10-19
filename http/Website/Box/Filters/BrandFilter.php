<?php

namespace Http\Website\Box\Filters;

use App\Base\Filter;
use App\Base\QueryBuilder;

class BrandFilter extends Filter
{
    public function process(QueryBuilder $query, ?string $pk = null): QueryBuilder
    {
        return $query
            ->filterByUser('creator_id')
            ->withoutTrashed()
            ->when($pk, function ($q) use ($pk) {
                $q->where('slug', $pk);
            });
    }
}
