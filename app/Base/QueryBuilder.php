<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;

class QueryBuilder extends Builder
{
    public function filterByUser($field): self
    {
        return $this->where($field, request()->user()->id);
    }
}
