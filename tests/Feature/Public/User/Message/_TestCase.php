<?php

namespace Tests\Feature\Public\User\Message;

use Tests\PostmanTestCase;
use App\Tests\Feature\Config\AuthConfig;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = AuthConfig::PUBLIC_HEADERS;

    protected string $requestUrl = 'user/message';
}
