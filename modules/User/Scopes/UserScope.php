<?php

namespace Modules\User\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope
{
    public function __construct(
        private string $field,
        private ?int $id = null,
    ) {
    }

    public function apply(Builder $builder, Model $model): void
    {
        $this->id ??= request()->user()->id;
        $builder->where($this->field, $this->id);
    }
}
