<?php

namespace Http\Website\Box\Tests\Category;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_AUTH_WEBSITE_HEADERS;

    public string $requestUrl = 'website/box/category';
}
