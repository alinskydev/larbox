<?php

namespace App\Search\Filter\Types;

use App\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class Datetime extends SearchFilterType
{
    public function process(): void
    {
        $this->query->{$this->condition}(
            $this->field,
            date('Y-m-d H:i:s', strtotime($this->value))
        );
    }
}
