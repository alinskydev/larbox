<?php

namespace App\Search\Enums;

enum SearchFilterConditionEnum: string
{
    case WHERE = 'where';
    case OR_WHERE = 'orWhere';
}
