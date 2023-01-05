<?php

namespace Modules\Box\Query;

use Illuminate\Database\Eloquent\Builder;

class BoxQuery extends Builder
{
    public function published(): self
    {
        return $this->where('datetime', '<=', date('Y-m-d H:i:s'));
    }
}
