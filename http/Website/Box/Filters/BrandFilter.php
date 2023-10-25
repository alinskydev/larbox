<?php

namespace Http\Website\Box\Filters;

use App\Base\Filter;
use Illuminate\Database\Eloquent\Builder;

class BrandFilter extends Filter
{
    public function process(Builder $query, ?string $pk = null): Builder
    {
        return $query
            ->filterByUser('creator_id')
            ->withoutTrashed()
            ->when($pk, function ($q) use ($pk) {
                $q->where('slug', $pk);
            });
    }
}
