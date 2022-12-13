<?php

namespace App\Base\Search\Filter\Types;

use App\Base\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class Date extends SearchFilterType
{
    public function process()
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
