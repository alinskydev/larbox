<?php

namespace App\Base\Search\Filter\Types;

use App\Base\Search\Filter\SearchFilterType;
use Illuminate\Support\Facades\DB;

class LocalizedLike extends SearchFilterType
{
    public function process(): void
    {
        $locale = app()->getLocale();

        $this->query->{$this->condition}(
            DB::raw("LOWER($this->field->>'$locale')"),
            'LIKE',
            mb_strtolower((string)$this->value) . '%'
        );
    }
}
