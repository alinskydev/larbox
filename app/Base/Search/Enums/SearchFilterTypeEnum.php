<?php

namespace App\Base\Search\Enums;

use App\Base\Search\Filter\Types as FilterTypes;

enum SearchFilterTypeEnum: string
{
    case BETWEEN_DATE = FilterTypes\BetweenDate::class;
    case BETWEEN_DATETIME = FilterTypes\BetweenDatetime::class;
    case BETWEEN_NUMBER = FilterTypes\BetweenNumber::class;
    case DATE = FilterTypes\Date::class;
    case DATETIME = FilterTypes\Datetime::class;
    case EQUAL_RAW = FilterTypes\EqualRaw::class;
    case EQUAL_STRING = FilterTypes\EqualString::class;
    case IN = FilterTypes\In::class;
    case JSON_CONTAINS_ALL = FilterTypes\JsonContainsAll::class;
    case JSON_CONTAINS_ANY = FilterTypes\JsonContainsAny::class;
    case LIKE = FilterTypes\Like::class;
    case LOCALIZED_LIKE = FilterTypes\LocalizedLike::class;
}
