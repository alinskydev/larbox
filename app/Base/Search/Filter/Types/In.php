<?php

namespace App\Base\Search\Filter\Types;

use App\Base\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class In extends SearchFilterType
{
    public function process()
    {
        $this->value = (array)$this->value;

        $this->query->{$this->condition . 'In'}(
            $this->field,
            $this->value
        );
    }
}
