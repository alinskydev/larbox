<?php

namespace Http\Public\Box\Tests\Brand;

use App\Tests\Feature\PostmanTestCase;
use Modules\Box\Search\BrandSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_PUBLIC_HEADERS;

    protected string $requestUrl = 'box/brand';

    protected string $searchClass = BrandSearch::class;
}
