<?php

namespace App\Search\Filter\Types;

use App\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class JsonContainsAll extends SearchFilterType
{
    public function process(): void
    {
        $this->value = (array)$this->value;

        $this->query->{$this->condition}(function ($query) {
            foreach ($this->value as $v) {
                $query->whereJsonContains($this->field, $v);
            }
        });
    }
}
