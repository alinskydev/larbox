<?php

namespace Http\Website\User\Tests;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_AUTH_WEBSITE_HEADERS;

    public string $requestUrl = 'website/user';
}
