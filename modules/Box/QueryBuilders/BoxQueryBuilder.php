<?php

namespace Modules\Box\QueryBuilders;

use App\Base\QueryBuilder;

class BoxQueryBuilder extends QueryBuilder
{
    public function published(): self
    {
        return $this->where('datetime', '<=', date('Y-m-d H:i:s'));
    }
}
