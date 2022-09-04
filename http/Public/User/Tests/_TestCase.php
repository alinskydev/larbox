<?php

namespace Http\Public\User\Tests;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_PUBLIC_HEADERS;

    public string $requestUrl = 'user';
}
