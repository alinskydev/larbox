<?php

namespace Http\Public\User\Tests;

use App\Tests\Feature\PostmanTestCase;
use App\Tests\Feature\Config\AuthConfig;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = AuthConfig::PUBLIC_HEADERS;

    protected string $requestUrl = 'user';
}
