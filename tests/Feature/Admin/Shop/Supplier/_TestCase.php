<?php

namespace Tests\Feature\Admin\Shop\Supplier;

use Tests\PostmanTestCase;
use App\Tests\Feature\Config\AuthConfig;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = AuthConfig::ADMIN_HEADERS;

    protected string $requestUrl = 'admin/shop/supplier';
}
