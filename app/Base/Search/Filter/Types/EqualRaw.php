<?php

namespace App\Base\Search\Filter\Types;

use App\Base\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class EqualRaw extends SearchFilterType
{
    public function process()
    {
        $this->query->{$this->condition}(
            $this->field,
            $this->value
        );
    }
}
