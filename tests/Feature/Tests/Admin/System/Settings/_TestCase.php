<?php

namespace Tests\Feature\Tests\Admin\System\Settings;

use Tests\Feature\PostmanTestCase;
use Tests\Feature\Config\AuthConfig;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = AuthConfig::ADMIN_HEADERS;

    protected string $requestUrl = 'admin/system/settings';
}
