<?php

namespace App\Base\Search\Enums;

enum SearchSortTypeEnum: string
{
    case RAW = 'sortRaw';
    case LOCALIZED = 'sortLocalized';
}
