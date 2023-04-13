<?php

namespace App\Search\Filter\Types;

use App\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class BetweenDatetime extends SearchFilterType
{
    public function process(): void
    {
        $this->value = (array)$this->value;

        if (isset($this->value[0])) {
            $this->query->{$this->condition}(
                $this->field,
                '>=',
                date('Y-m-d H:i:s', strtotime($this->value[0]))
            );
        }

        if (isset($this->value[1])) {
            $this->query->{$this->condition}(
                $this->field,
                '<=',
                date('Y-m-d H:i:s', strtotime($this->value[1]))
            );
        }
    }
}
