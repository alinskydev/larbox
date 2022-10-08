<?php

namespace Http\Client\Box\Tests\Brand;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_CLIENT_HEADERS;

    public string $requestUrl = 'client/box/brand';
}
