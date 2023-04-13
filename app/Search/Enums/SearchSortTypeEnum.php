<?php

namespace App\Search\Enums;

enum SearchSortTypeEnum: string
{
    case RAW = 'sortRaw';
    case LOCALIZED = 'sortLocalized';
}
