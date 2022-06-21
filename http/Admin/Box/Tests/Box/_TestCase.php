<?php

namespace Http\Admin\Box\Tests\Box;

use App\Tests\Feature\PostmanTestCase;
use Modules\Box\Search\BoxSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    protected string $requestUrl = 'admin/box/box';

    protected string $searchClass = BoxSearch::class;
}
