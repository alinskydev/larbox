<?php

namespace Http\Client\User\Tests;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_CLIENT_HEADERS;

    public string $requestUrl = 'client/user';
}
