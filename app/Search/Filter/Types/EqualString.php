<?php

namespace App\Search\Filter\Types;

use App\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class EqualString extends SearchFilterType
{
    public function process(): void
    {
        $this->query->{$this->condition}(
            DB::raw("LOWER($this->field::TEXT)"),
            mb_strtolower((string)$this->value)
        );
    }
}
