<?php

namespace App\Search\Filter\Types;

use App\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class Date extends SearchFilterType
{
    public function process(): void
    {
        $this->query->{$this->condition}(function ($query) {
            $query
                ->where(
                    $this->field,
                    '>=',
                    date('Y-m-d 00:00:00', strtotime($this->value))
                )
                ->where(
                    $this->field,
                    '<=',
                    date('Y-m-d 23:59:59', strtotime($this->value))
                );
        });
    }
}
