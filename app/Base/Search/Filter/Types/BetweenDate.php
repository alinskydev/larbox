<?php

namespace App\Base\Search\Filter\Types;

use App\Base\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class BetweenDate extends SearchFilterType
{
    public function process()
    {
        $this->value = (array)$this->value;

        if (isset($this->value[0])) {
            $this->query->{$this->condition}(
                $this->field,
                '>=',
                date('Y-m-d 00:00:00', strtotime($this->value[0]))
            );
        }

        if (isset($this->value[1])) {
            $this->query->{$this->condition}(
                $this->field,
                '<=',
                date('Y-m-d 23:59:59', strtotime($this->value[1]))
            );
        }
    }
}
