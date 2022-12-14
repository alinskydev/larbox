<?php

namespace App\Base\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchShow
{
    public function __construct(
        private Builder $query,
        private array $params,
    ) {
    }

    public function process(): void
    {
        $model = $this->query->getModel();
        $hasSoftDelete = in_array(SoftDeletes::class, class_uses_recursive($model));

        foreach ($this->params as $param) {
            switch ($param) {
                case 'with-deleted':
                    if ($hasSoftDelete) $this->query->withTrashed();
                    break;
                case 'only-deleted':
                    if ($hasSoftDelete) $this->query->onlyTrashed();
                    break;
            }
        }
    }
}
