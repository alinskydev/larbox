<?php

namespace App\Base\Search\Filter\Types;

use App\Base\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class Like extends SearchFilterType
{
    public function process(): void
    {
        $this->query->{$this->condition}(
            DB::raw("LOWER($this->field::VARCHAR)"),
            'LIKE',
            '%' . mb_strtolower((string)$this->value) . '%'
        );
    }
}
