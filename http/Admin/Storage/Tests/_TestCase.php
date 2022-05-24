<?php

namespace Http\Admin\Storage\Tests;

use App\Tests\Feature\PostmanTestCase;
use App\Tests\Feature\Config\AuthConfig;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = AuthConfig::ADMIN_HEADERS;

    protected string $requestUrl = 'admin/storage';
}
