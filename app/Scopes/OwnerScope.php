<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OwnerScope implements Scope
{
    public function __construct(
        private string $field = 'creator_id',
        private ?int $id = null,
    ) {
    }

    public function apply(Builder $builder, Model $model)
    {
        $id = $this->id ?? auth()->user()->id;
        $builder->where($this->field, $id);
    }
}
