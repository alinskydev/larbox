<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Tests\Feature\PostmanTestCase;
use Modules\Box\Search\BrandSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    protected string $requestUrl = 'admin/box/brand';

    protected string $searchClass = BrandSearch::class;
}
