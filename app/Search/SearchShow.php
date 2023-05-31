<?php

namespace App\Search;

use App\Base\QueryBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchShow
{
    public function __construct(
        private QueryBuilder $query,
        private array $params,
    ) {
    }

    public function process(): void
    {
        $model = $this->query->getModel();
        $hasSoftDelete = in_array(SoftDeletes::class, class_uses_recursive($model));

        if (!$hasSoftDelete) return;

        if (in_array('with-deleted', $this->params)) {
            $this->query->withTrashed();
        }

        if (in_array('only-deleted', $this->params)) {
            $this->query->onlyTrashed();
        }
    }
}
