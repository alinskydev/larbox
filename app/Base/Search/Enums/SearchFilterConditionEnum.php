<?php

namespace App\Base\Search\Enums;

enum SearchFilterConditionEnum: string
{
    case WHERE = 'where';
    case OR_WHERE = 'orWhere';
}
